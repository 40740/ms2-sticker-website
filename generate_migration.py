#!/usr/bin/env python3
"""
SQLite → Laravel Initial Data Migration 导出工具

从本地 SQLite 数据库导出所有业务数据，生成一个 Laravel Migration 文件。
使用 DB::table()->insertOrIgnore() 直接插入，绕过 Model 层。

优势：
- 不依赖自增 ID（直接用原始值）
- 幂等操作（insertOrIgnore 跳过已存在的记录）
- 随 php artisan migrate 自动执行，无需单独 db:seed
- 跨数据库兼容（SQLite → PostgreSQL）

用法: python generate_migration.py [输出路径]
默认输出到 database/migrations/2026_05_22_000001_populate_initial_data.php
"""

import sqlite3
import json
import os
import sys
from datetime import datetime

DB_PATH = os.path.join(os.path.dirname(__file__), 'database', 'database.sqlite')
DEFAULT_OUTPUT = os.path.join(os.path.dirname(__file__), 'database', 'migrations', '2026_05_22_000001_populate_initial_data.php')


def php_escape(s):
    """转义字符串用于 PHP 双引号"""
    if s is None:
        return ''
    s = str(s)
    s = s.replace('\\', '\\\\')
    s = s.replace('"', '\\"')
    s = s.replace('$', '\\$')
    s = s.replace('\n', '\\n')
    s = s.replace('\r', '\\r')
    s = s.replace('\t', '\\t')
    return s


def get_table_columns(cur, table_name):
    cur.execute(f'PRAGMA table_info({table_name})')
    return [col[1] for col in cur.fetchall()]


def export_table_raw(cur, table, order_by='id'):
    """原始导出表数据"""
    cur.execute(f'SELECT * FROM {table} ORDER BY {order_by}')
    rows = cur.fetchall()
    cols = get_table_columns(cur, table)
    items = [dict(zip(cols, r)) for r in rows]
    return table, cols, items


def generate_migration_code(tables_data):
    parts = []

    for table_name, columns, rows in tables_data:
        if not rows:
            continue

        parts.append(f"        // --- {table_name} ({len(rows)} records) ---")

        for row in rows:
            col_values = []
            for col in columns:
                val = row.get(col)
                if val is None:
                    col_values.append(f"'{col}' => null")
                elif isinstance(val, bool):
                    col_values.append(f"'{col}' => {int(val)}")
                elif isinstance(val, (int, float)):
                    col_values.append(f"'{col}' => {val}")
                else:
                    escaped = php_escape(str(val))
                    col_values.append(f"'{col}' => \"{escaped}\"")

            parts.append(f"        \\DB::table('{table_name}')->insertOrIgnore([")
            for cv in col_values:
                parts.append(f"            {cv},")
            parts.append("        ]);")
            parts.append("")

    return '\n'.join(parts)


def main():
    output_path = sys.argv[1] if len(sys.argv) > 1 else DEFAULT_OUTPUT
    db_path = sys.argv[2] if len(sys.argv) > 2 else DB_PATH

    print(f"Reading SQLite database: {db_path}")
    conn = sqlite3.connect(db_path)
    conn.row_factory = sqlite3.Row
    cur = conn.cursor()

    tables_data = []
    table_list = [
        ('settings', 'Settings'),
        ('categories', 'Categories'),
        ('products', 'Products'),
        ('faqs', 'FAQs'),
        ('blog_posts', 'Blog Posts'),
        ('certificates', 'Certificates'),
        ('brands', 'Brands'),
        ('team_members', 'Team Members'),
    ]

    for table, label in table_list:
        print(f"Exporting {label}...")
        t, c, r = export_table_raw(cur, table)
        print(f"  -> {len(r)} records")
        tables_data.append((t, c, r))

    conn.close()

    total = sum(len(r) for _, _, r in tables_data)
    migration_body = generate_migration_code(tables_data)
    ts = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    # Build PHP file using string concatenation to avoid f-string brace issues
    lines = []
    lines.append('<?php')
    lines.append('')
    lines.append('use Illuminate\\Database\\Migrations\\Migration;')
    lines.append('use Illuminate\\Support\\Facades\\DB;')
    lines.append('')
    lines.append('return new class extends Migration')
    lines.append('{')
    lines.append('    /**')
    lines.append(f'     * Populate initial data from local SQLite database.')
    lines.append(f'     * Generated: {ts}')
    lines.append(f'     * Total records: {total}')
    lines.append('     *')
    lines.append('     * Uses insertOrIgnore() for idempotency - safe to run multiple times.')
    lines.append('     */')
    lines.append('    public function up(): void')
    lines.append('    {')
    lines.append("        // Only populate if settings table is empty (first-time setup)")
    lines.append("        if (DB::table('settings')->count() > 0) {")
    lines.append("            $this->command?->info('Initial data already exists, skipping.');")
    lines.append('            return;')
    lines.append('        }')
    lines.append('')
    lines.append(migration_body)
    lines.append(f"        $this->command?->info('Populated {total} initial records.');")
    lines.append('    }')
    lines.append('')
    lines.append('    public function down(): void')
    lines.append('    {')
    lines.append('        // Intentionally empty - never auto-delete production data')
    lines.append('    }')
    lines.append('};')

    php_code = '\n'.join(lines)

    os.makedirs(os.path.dirname(output_path), exist_ok=True)

    with open(output_path, 'w', encoding='utf-8') as f:
        f.write(php_code)

    size_kb = len(php_code.encode('utf-8')) / 1024
    print(f"\nDone! {output_path} ({size_kb:.1f} KB)")
    print(f"\nSummary:")
    for t, _, r in tables_data:
        print(f"  {t:<20} {len(r):>4} records")
    print(f"  {'TOTAL':<20} {total:>4} records")


if __name__ == '__main__':
    main()
