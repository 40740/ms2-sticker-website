#!/usr/bin/env python3
"""
SQLite → Laravel DatabaseSeeder 导出工具
从本地 SQLite 数据库导出所有业务数据，生成完整的 DatabaseSeeder.php

用法: python export_seeder.py [输出路径]
默认输出到 database/seeders/DatabaseSeeder.php
"""

import sqlite3
import json
import os
import re
import sys
from datetime import datetime

DB_PATH = os.path.join(os.path.dirname(__file__), 'database', 'database.sqlite')
OUTPUT_PATH = os.path.join(os.path.dirname(__file__), 'database', 'seeders', 'DatabaseSeeder.php')


def php_escape(s):
    """转义字符串用于 PHP 单引号/双引号"""
    if s is None:
        return 'null'
    s = str(s)
    # 转义反斜杠、双引号、美元符号、换行等
    s = s.replace('\\', '\\\\')
    s = s.replace('"', '\\"')
    s = s.replace('$', '\\$')
    s = s.replace('\n', '\\n')
    s = s.replace('\r', '\\r')
    s = s.replace('\t', '\\t')
    return s


def php_bool(v):
    """转换 Python bool 到 PHP bool 字符串"""
    if v is None:
        return 'null'
    if isinstance(v, int):
        return 'true' if v else 'false'
    return 'true' if v else 'false'


def php_int(v):
    """转换 Python int 到 PHP int"""
    if v is None:
        return 'null'
    return str(int(v))


def php_value(v):
    """自动检测类型并转换为 PHP 值表示"""
    if v is None:
        return 'null'
    if isinstance(v, bool) or (isinstance(v, int) and v in (0, 1) and str(v) == str(bool(v))):
        # 区分布尔和整数 — 在我们的场景中 0/1 视为 int
        return str(int(v))
    if isinstance(v, int):
        return str(v)
    if isinstance(v, float):
        return str(v)
    return '"' + php_escape(str(v)) + '"'


def format_php_array(data, indent=3):
    """将 dict/list 格式化为 PHP 数组字符串"""
    lines = []
    prefix = '    ' * indent

    if isinstance(data, dict):
        if not data:
            return '[]'
        for k, v in data.items():
            key = php_escape(k) if not k.isdigit() else k
            if isinstance(v, (dict, list)):
                val_str = format_php_array(v, indent + 1)
            elif v is None:
                val_str = 'null'
            else:
                val_str = php_value(v)
            lines.append(f'{prefix}\'{key}\' => {val_str},')
        return "[\n" + "\n".join(lines) + "\n" + prefix[4:] + "]"

    elif isinstance(data, list):
        if not data:
            return '[]'
        for item in data:
            if isinstance(item, (dict, list)):
                item_str = format_php_array(item, indent + 1)
            elif item is None:
                item_str = 'null'
            else:
                item_str = php_value(item)
            lines.append(f'{prefix}{item_str},')
        return "[\n" + "\n".join(lines) + "\n" + prefix[4:] + "]"

    return 'null'


def get_table_columns(cur, table_name):
    """获取表的所有列名"""
    cur.execute(f'PRAGMA table_info({table_name})')
    return [col[1] for col in cur.fetchall()]


def export_settings(cur):
    """导出 settings 表"""
    cur.execute('SELECT * FROM settings ORDER BY id')
    rows = cur.fetchall()
    cols = get_table_columns(cur, 'settings')

    items = []
    for r in rows:
        row = dict(zip(cols, r))
        items.append({
            'key': row['key'],
            'value': row['value'],
            'group': row.get('group', ''),
        })

    return ('settings', items, 'key')


def export_categories(cur):
    """导出 categories 表"""
    cur.execute('SELECT * FROM categories ORDER BY id')
    rows = cur.fetchall()
    cols = get_table_columns(cur, 'categories')

    items = []
    for r in rows:
        row = dict(zip(cols, r))
        cat = {
            'name': row['name'],
            'slug': row['slug'],
            'type': row['type'],
            'description': row.get('description') or '',
            'category_group': row.get('category_group') or '',
            'hero_title': row.get('hero_title'),
            'hero_subtitle': row.get('hero_subtitle'),
            'image': row.get('image'),
            'hero_image': row.get('hero_image'),
            'sort_order': row.get('sort_order', 0),
            'is_active': row.get('is_active', 1),
        }
        items.append(cat)

    return ('categories (by slug)', items, 'slug')


def export_products(cur):
    """导出 products 表"""
    cur.execute('SELECT * FROM products ORDER BY id')
    rows = cur.fetchall()
    cols = get_table_columns(cur, 'products')

    items = []
    for r in rows:
        row = dict(zip(cols, r))
        product = {
            'name': row['name'],
            'slug': row['slug'],
            'type': row.get('type', 'sticker'),
            'category_id': row['category_id'],
            'description': row.get('description') or '',
            'image': row.get('image'),
            'hero_title': row.get('hero_title'),
            'hero_subtitle': row.get('hero_subtitle'),
            'hero_image': row.get('hero_image'),
        }

        # JSON fields - parse from stored JSON string or use as-is
        for field in ['features', 'steps', 'concerns', 'testimonials']:
            val = row.get(field)
            if val:
                try:
                    parsed = json.loads(val) if isinstance(val, str) else val
                    product[field] = parsed
                except (json.JSONDecodeError, TypeError):
                    product[field] = val

        product['is_active'] = row.get('is_active', 1)
        product['sort_order'] = row.get('sort_order', 0)
        items.append(product)

    return ('products', items, 'slug')


def export_faqs(cur):
    """导出 faqs 表"""
    cur.execute('SELECT * FROM faqs ORDER BY id')
    rows = cur.fetchall()
    cols = get_table_columns(cur, 'faqs')

    items = []
    for r in rows:
        row = dict(zip(cols, r))
        items.append({
            'question': row['question'],
            'answer': row.get('answer') or '',
            'product_id': row.get('product_id'),
            'category_id': row.get('category_id'),
            'sort_order': row.get('sort_order', 0),
            'is_active': row.get('is_active', 1),
        })

    return ('faqs', items, None)  # FAQs don't have a unique slug, use all fields


def export_blog_posts(cur):
    """导出 blog_posts 表"""
    cur.execute('SELECT * FROM blog_posts ORDER BY id')
    rows = cur.fetchall()
    cols = get_table_columns(cur, 'blog_posts')

    items = []
    for r in rows:
        row = dict(zip(cols, r))
        post = {
            'title': row['title'],
            'slug': row['slug'],
            'excerpt': row.get('excerpt') or '',
            'content': row.get('content') or '',
            'image': row.get('image'),
            'meta_title': row.get('meta_title'),
            'meta_description': row.get('meta_description'),
            'is_published': row.get('is_published', 1),
            'published_at': row.get('published_at'),
        }
        items.append(post)

    return ('blog_posts', items, 'slug')


def export_brands(cur):
    """导出 brands 表"""
    cur.execute('SELECT * FROM brands ORDER BY sort_order, id')
    rows = cur.fetchall()
    cols = get_table_columns(cur, 'brands')

    items = []
    for r in rows:
        row = dict(zip(cols, r))
        items.append({
            'name': row['name'],
            'image': row.get('image'),
            'link': row.get('link'),
            'sort_order': row.get('sort_order', 0),
            'is_active': row.get('is_active', 1),
        })

    return ('brands', items, 'name')


def export_certificates(cur):
    """导出 certificates 表"""
    cur.execute('SELECT * FROM certificates ORDER BY sort_order, id')
    rows = cur.fetchall()
    cols = get_table_columns(cur, 'certificates')

    items = []
    for r in rows:
        row = dict(zip(cols, r))
        items.append({
            'name': row['name'],
            'image': row.get('image'),
            'sort_order': row.get('sort_order', 0),
            'is_active': row.get('is_active', 1),
        })

    return ('certificates', items, 'name')


def export_team_members(cur):
    """导出 team_members 表"""
    cur.execute('SELECT * FROM team_members ORDER BY sort_order, id')
    rows = cur.fetchall()
    cols = get_table_columns(cur, 'team_members')

    items = []
    for r in rows:
        row = dict(zip(cols, r))
        items.append({
            'name': row['name'],
            'title': row.get('title'),
            'avatar': row.get('avatar'),
            'bio': row.get('bio') or '',
            'sort_order': row.get('sort_order', 0),
            'is_active': row.get('is_active', 1),
        })

    return ('team_members', items, 'name')


def generate_settings_code(items):
    """生成 Settings 的 PHP Seeder 代码"""
    lines = []
    lines.append("        // ─── Settings ───────────────────────────────────────")
    lines.append(f"        $settings = [")

    current_group = ''
    for item in items:
        group = item.get('group', '')
        if group and group != current_group:
            current_group = group
            lines.append(f"")
            # Group comment
            group_label = group.capitalize() if group else 'Other'
            lines.append(f"            // {group_label}")

        key_escaped = php_escape(item['key'])
        value_escaped = php_escape(item['value'])
        group_escaped = php_escape(item['group'])
        lines.append(f"            ['key' => '{key_escaped}', 'value' => \"{value_escaped}\", 'group' => '{group_escaped}'],")

    lines.append("        ];")
    lines.append("")
    lines.append("        foreach ($settings as $setting) {")
    lines.append("            Setting::updateOrCreate(['key' => $setting['key']], $setting);")
    lines.append("        }")
    lines.append("")
    return '\n'.join(lines)


def generate_categories_code(items):
    """生成 Categories 的 PHP Seeder 代码 — 按类型分组"""
    from collections import OrderedDict

    type_groups = OrderedDict()
    for item in items:
        t = item.get('type', 'sticker')
        if t not in type_groups:
            type_groups[t] = []
        type_groups[t].append(item)

    lines = []
    for type_name, cats in type_groups.items():
        var_name = f"{type_name}Categories"
        label = type_name.capitalize()

        lines.append(f"        // ─── Categories ({label}s) ────────────────────────")
        lines.append(f"        ${var_name} = [")

        for i, cat in enumerate(cats):
            name_e = php_escape(cat['name'])
            slug_e = php_escape(cat['slug'])
            desc_e = php_escape(cat.get('description') or '')

            line = f"            ['name' => '{name_e}', 'slug' => '{slug_e}', 'description' => \"{desc_e}\""

            # Add optional fields only if they have values
            if cat.get('hero_title'):
                line += f", 'hero_title' => \"{php_escape(cat['hero_title'])}\""
            if cat.get('hero_subtitle'):
                line += f", 'hero_subtitle' => \"{php_escape(cat['hero_subtitle'])}\""
            if cat.get('image'):
                img_val = 'null' if cat['image'] == 'None' else f"'{php_escape(cat['image'])}'"
                line += f", 'image' => {img_val}"
            if cat.get('hero_image'):
                img_val = 'null' if cat['hero_image'] == 'None' else f"'{php_escape(cat['hero_image'])}'"
                line += f", 'hero_image' => {img_val}"
            if cat.get('category_group'):
                cg_val = 'null' if cat['category_group'] == 'None' else f"'{php_escape(cat['category_group'])}'"
                line += f", 'category_group' => {cg_val}"

            line += "],"
            lines.append(line)

        lines.append("        ];")
        lines.append("")
        lines.append(f"        foreach (${var_name} as $i => $cat) {{")
        lines.append(f"            Category::firstOrCreate(['slug' => $cat['slug']], array_merge($cat, [")
        lines.append(f"                'type' => '{type_name}',")
        lines.append(f"                'is_active' => true,")
        lines.append(f"                'sort_order' => $i + 1,")
        lines.append(f"            ]));")
        lines.append(f"        }}")
        lines.append("")

    return '\n'.join(lines)


def generate_products_code(items):
    """生成 Products 的 PHP Seeder 代码"""
    lines = []

    # First, build category lookup by category_id -> slug
    lines.append("        // ─── Products ──────────────────────────────────────")

    # Collect unique category_ids and create lookups
    cat_ids = sorted(set(p['category_id'] for p in items))

    # We need to look up categories by ID. Let's create variable names based on category slugs
    # For this we'll need to know which slug each category_id maps to
    lines.append("")
    for cid in cat_ids:
        lines.append(f"        $_cat{cid} = Category::find({cid});")

    lines.append("")

    for i, prod in enumerate(items):
        cid = prod['category_id']
        name_e = php_escape(prod['name'])
        slug_e = php_escape(prod['slug'])
        type_e = php_escape(prod.get('type', 'sticker'))
        desc_e = php_escape(prod.get('description') or '')

        lines.append(f"        // Product {i+1}: {prod['name']}")
        lines.append(f"        Product::updateOrCreate(['slug' => '{slug_e}'], [")
        lines.append(f"            'category_id' => $_cat{cid}?->id,")
        lines.append(f"            'name' => '{name_e}',")
        lines.append(f"            'slug' => '{slug_e}',")
        lines.append(f"            'type' => '{type_e}',")
        lines.append(f"            'description' => \"{desc_e}\",")

        # Optional simple fields
        for field in ['image', 'hero_title', 'hero_subtitle', 'hero_image']:
            val = prod.get(field)
            if val and str(val) != 'None':
                lines.append(f"            '{field}' => '{php_escape(val)}',")

        # JSON array fields
        for field in ['features', 'steps', 'concerns', 'testimonials']:
            val = prod.get(field)
            if val and str(val) != 'None':
                try:
                    if isinstance(val, str):
                        parsed = json.loads(val)
                    else:
                        parsed = val
                    arr_str = format_php_array(parsed, 5)
                    lines.append(f"            '{field}' => {arr_str},")
                except (json.JSONDecodeError, TypeError):
                    pass

        lines.append(f"            'is_active' => {php_bool(prod.get('is_active', True))},")
        lines.append(f"            'sort_order' => {php_int(prod.get('sort_order', i + 1))},")
        lines.append("        ]);")
        lines.append("")

    return '\n'.join(lines)


def generate_faqs_code(items):
    """生成 FAQs 的 PHP Seeder 代码"""
    lines = []
    lines.append("        // ─── FAQs ──────────────────────────────────────────")
    lines.append(f"        $faqs = [")

    for item in items:
        q_e = php_escape(item['question'])
        a_e = php_escape(item.get('answer') or '')
        pid = 'null' if not item.get('product_id') else str(item['product_id'])
        cid = 'null' if not item.get('category_id') else str(item['category_id'])
        so = str(item.get('sort_order', 0))
        active = php_bool(item.get('is_active', True))

        lines.append(f"            [")
        lines.append(f"                'question' => \"{q_e}\",")
        lines.append(f"                'answer' => \"{a_e}\",")
        lines.append(f"                'product_id' => {pid},")
        lines.append(f"                'category_id' => {cid},")
        lines.append(f"                'sort_order' => {so},")
        lines.append(f"                'is_active' => {active},")
        lines.append(f"            ],")

    lines.append("        ];")
    lines.append("")
    lines.append("        foreach ($faqs as $faq) {")
    lines.append("            Faq::create($faq);")
    lines.append("        }")
    lines.append("")

    return '\n'.join(lines)


def generate_blog_posts_code(items):
    """生成 BlogPosts 的 PHP Seeder 代码"""
    lines = []
    lines.append("        // ─── Blog Posts ────────────────────────────────────")
    lines.append("        $blogPosts = [")

    for item in items:
        title_e = php_escape(item['title'])
        slug_e = php_escape(item['slug'])
        excerpt_e = php_escape(item.get('excerpt') or '')
        content_e = php_escape(item.get('content') or '')
        image_v = 'null' if not item.get('image') else f"'{php_escape(item['image'])}'"
        mt_e = php_escape(item.get('meta_title') or '') or 'null'
        md_e = php_escape(item.get('meta_description') or '') or 'null'

        lines.append(f"            [")
        lines.append(f"                'title' => '{title_e}',")
        lines.append(f"                'slug' => '{slug_e}',")
        lines.append(f"                'excerpt' => \"{excerpt_e}\",")
        lines.append(f"                'content' => \"{content_e}\",")
        lines.append(f"                'image' => {image_v},")

        if mt_e != 'null':
            lines.append(f"                'meta_title' => \"{mt_e}\",")
        if md_e != 'null':
            lines.append(f"                'meta_description' => \"{md_e}\",")

        pub = php_bool(item.get('is_published', True))
        lines.append(f"                'is_published' => {pub},")
        lines.append(f"            ],")

    lines.append("        ];")
    lines.append("")
    lines.append("        foreach ($blogPosts as $i => $post) {")
    lines.append("            BlogPost::updateOrCreate(['slug' => $post['slug']], array_merge($post, [")
    lines.append("                'published_at' => now()->subDays(count($blogPosts) - $i),")
    lines.append("            ]));")
    lines.append("        }")
    lines.append("")

    return '\n'.join(lines)


def generate_brands_code(items):
    """生成 Brands 的 PHP Seeder 代码"""
    lines = []
    lines.append("        // ─── Brands ───────────────────────────────────────")
    lines.append("        $brands = [")

    for item in items:
        name_e = php_escape(item['name'])
        image_v = "'{}'".format(php_escape(item['image'])) if item.get('image') else 'null'
        link_v = "'{}'".format(php_escape(item['link'])) if item.get('link') else 'null'
        lines.append(f"            ['name' => '{name_e}', 'image' => {image_v}, 'link' => {link_v}],")

    lines.append("        ];")
    lines.append("")
    lines.append("        foreach ($brands as $i => $brand) {")
    lines.append("            Brand::updateOrCreate(['name' => $brand['name']], array_merge($brand, [")
    lines.append("                'sort_order' => $i + 1,")
    lines.append("                'is_active' => true,")
    lines.append("            ]));")
    lines.append("        }")
    lines.append("")

    return '\n'.join(lines)


def generate_certificates_code(items):
    """生成 Certificates 的 PHP Seeder 代码"""
    lines = []
    lines.append("        // ─── Certificates ─────────────────────────────────")
    lines.append("        $certificates = [")

    for item in items:
        name_e = php_escape(item['name'])
        image_v = "'{}'".format(php_escape(item['image'])) if item.get('image') else 'null'
        lines.append(f"            ['name' => '{name_e}', 'image' => {image_v}],")

    lines.append("        ];")
    lines.append("")
    lines.append("        foreach ($certificates as $i => $cert) {")
    lines.append("            Certificate::updateOrCreate(['name' => $cert['name']], array_merge($cert, [")
    lines.append("                'sort_order' => $i + 1,")
    lines.append("                'is_active' => true,")
    lines.append("            ]));")
    lines.append("        }")
    lines.append("")

    return '\n'.join(lines)


def generate_team_members_code(items):
    """生成 TeamMembers 的 PHP Seeder 代码"""
    lines = []
    lines.append("        // ─── Team Members ─────────────────────────────────")
    lines.append("        $teamMembers = [")

    for item in items:
        name_e = php_escape(item['name'])
        title_e = php_escape(item.get('title') or '')
        avatar_v = "'{}'".format(php_escape(item['avatar'])) if item.get('avatar') else 'null'
        bio_e = php_escape(item.get('bio') or '')
        lines.append(f"            [")
        lines.append(f"                'name' => '{name_e}',")
        lines.append(f"                'title' => '{title_e}',")
        lines.append(f"                'avatar' => {avatar_v},")
        lines.append(f"                'bio' => \"{bio_e}\",")
        lines.append(f"            ],")

    lines.append("        ];")
    lines.append("")
    lines.append("        foreach ($teamMembers as $i => $member) {")
    lines.append("            TeamMember::updateOrCreate(['name' => $member['name']], array_merge($member, [")
    lines.append("                'sort_order' => $i + 1,")
    lines.append("                'is_active' => true,")
    lines.append("            ]));")
    lines.append("        }")
    lines.append("")

    return '\n'.join(lines)


def main():
    output_path = sys.argv[1] if len(sys.argv) > 1 else OUTPUT_PATH
    db_path = sys.argv[2] if len(sys.argv) > 2 else DB_PATH

    print(f"Reading SQLite database: {db_path}")
    conn = sqlite3.connect(db_path)
    conn.row_factory = sqlite3.Row
    cur = conn.cursor()

    # Export each table
    print("Exporting Settings...")
    settings_data = export_settings(cur)
    print(f"  → {len(settings_data[1])} records")

    print("Exporting Categories...")
    categories_data = export_categories(cur)
    print(f"  → {len(categories_data[1])} records")

    print("Exporting Products...")
    products_data = export_products(cur)
    print(f"  → {len(products_data[1])} records")

    print("Exporting FAQs...")
    faqs_data = export_faqs(cur)
    print(f"  → {len(faqs_data[1])} records")

    print("Exporting Blog Posts...")
    blogs_data = export_blog_posts(cur)
    print(f"  → {len(blogs_data[1])} records")

    print("Exporting Brands...")
    brands_data = export_brands(cur)
    print(f"  → {len(brands_data[1])} records")

    print("Exporting Certificates...")
    certs_data = export_certificates(cur)
    print(f"  → {len(certs_data[1])} records")

    print("Exporting Team Members...")
    team_data = export_team_members(cur)
    print(f"  → {len(team_data[1])} records")

    conn.close()

    # Generate the full PHP file
    timestamp = datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    php_code = f'''<?php

/**
 * AUTO-GENERATED DatabaseSeeder
 *
 * Generated: {timestamp}
 * Source: local SQLite database ({os.path.basename(db_path)})
 *
 * ⚠️  This file is auto-generated by export_seeder.py.
 *     To regenerate: python export_seeder.py
 *
 * All data uses updateOrCreate / firstOrCreate for safe repeated seeding.
 */

namespace Database\\Seeders;

use App\\Models\\Brand;
use App\\Models\\BlogPost;
use App\\Models\\Category;
use App\\Models\\Certificate;
use App\\Models\\Faq;
use App\\Models\\Product;
use App\\Models\\Setting;
use App\\Models\\TeamMember;
use Illuminate\\Database\\Seeder;

class DatabaseSeeder extends Seeder
{{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {{
        // ─── Assign Category Groups ─────────────────────────────────
        $this->call(AssignCategoryGroupsSeeder::class);

        // ─── Seed all data (idempotent: skip records that already exist) ──
        try {{
            $this->seedAll();
        }} catch (\\Illuminate\\Database\\UniqueConstraintViolationException $e) {{
            // Already seeded — safe to ignore
        }}
    }}

    protected function seedAll(): void
    {{
        // All record creation below uses updateOrCreate / firstOrCreate for idempotency

{generate_settings_code(settings_data[1])}
{generate_categories_code(categories_data[1])}
{generate_products_code(products_data[1])}
{generate_faqs_code(faqs_data[1])}
{generate_blog_posts_code(blogs_data[1])}
{generate_certificates_code(certs_data[1])}
{generate_brands_code(brands_data[1])}
{generate_team_members_code(team_data[1])}

        // ─── Admin User ──────────────────────────────────────────────
        \\App\\Models\\User::updateOrCreate(
            ['email' => 'admin@meisaiprinting.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }} // end seedAll()
}}
'''

    # Ensure output directory exists
    os.makedirs(os.path.dirname(output_path), exist_ok=True)

    with open(output_path, 'w', encoding='utf-8') as f:
        f.write(php_code)

    size_kb = len(php_code.encode('utf-8')) / 1024
    print(f"\n✅ Generated: {output_path} ({size_kb:.1f} KB)")
    print(f"\nSummary:")
    print(f"  Settings:      {len(settings_data[1]):>4} records")
    print(f"  Categories:    {len(categories_data[1]):>4} records")
    print(f"  Products:      {len(products_data[1]):>4} records")
    print(f"  FAQs:          {len(faqs_data[1]):>4} records")
    print(f"  Blog Posts:    {len(blogs_data[1]):>4} records")
    print(f"  Certificates:  {len(certs_data[1]):>4} records")
    print(f"  Brands:        {len(brands_data[1]):>4} records")
    print(f"  Team Members:  {len(team_data[1]):>4} records")


if __name__ == '__main__':
    main()
