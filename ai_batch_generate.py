#!/usr/bin/env python3
"""
AI 批量生成产品图片
使用多模态服务为所有产品生成高质量的 AI 图片

使用方式：
1. 直接运行: python ai_batch_generate.py
2. 指定数量: python ai_batch_generate.py --count 10
3. 从指定 ID 开始: python ai_batch_generate.py --start-id 50
"""

import sqlite3
import os
import sys
import time
import json
import subprocess
import requests
from pathlib import Path

# 配置
DB_PATH = 'database/database.sqlite'
IMAGES_DIR = 'public/images/products'
SCRIPT_PATH = 'D:/Program Files/WorkBuddy/resources/app.asar.unpacked/resources/builtin-skills/buddy-multimodal-generation/scripts/buddy-cloud.py'
PYTHON_EXE = 'C:/Users/lin85/AppData/Local/Programs/Python/Python311/python.exe'
TOKEN = 'tk_zcTADqRgsDgyhIpWEjl1UMgIPXB3iqh3'

# 确保目录存在
Path(IMAGES_DIR).mkdir(parents=True, exist_ok=True)

def get_all_products():
    """获取所有产品"""
    conn = sqlite3.connect(DB_PATH)
    cursor = conn.cursor()
    cursor.execute('''
        SELECT p.id, p.name, p.slug, c.name as category_name
        FROM products p
        JOIN categories c ON p.category_id = c.id
        ORDER BY p.id
    ''')
    products = cursor.fetchall()
    conn.close()
    return products

def generate_prompt(product_name, category_name):
    """为产品生成匹配的 AI 图片提示词"""
    prompts = []

    # 根据分类选择基础风格
    if 'Sticker' in category_name or 'Sticker' in product_name:
        base = f"Professional product photography of {product_name}"
        prompts.append(f"{base}, colorful custom stickers arranged beautifully, white background, commercial photography, high quality, sharp details")
        prompts.append(f"{base}, multiple stickers with different designs, flat lay photography, white background, studio lighting, professional")
        prompts.append(f"{base}, artistic arrangement of stickers, creative composition, white background, product showcase, commercial style")

    elif 'Label' in category_name or 'Label' in product_name:
        base = f"Professional product photography of {product_name}"
        prompts.append(f"{base}, elegant label design mockup, white background, commercial photography, high quality")
        prompts.append(f"{base}, premium packaging label, clean design, white background, studio lighting, professional")
        prompts.append(f"{base}, custom printed label on bottle, minimalist design, white background, product photography")

    elif 'Packaging' in category_name or 'Packaging' in product_name:
        base = f"Professional product photography of {product_name}"
        prompts.append(f"{base}, creative packaging design, white background, commercial photography, high quality")
        prompts.append(f"{base}, custom box packaging mockup, clean design, white background, studio lighting")
        prompts.append(f"{base}, sustainable packaging solution, white background, product showcase")

    else:
        # 默认模板
        base = f"Professional product photography of {product_name}"
        prompts.append(f"{base}, white background, commercial photography, high quality, sharp details")
        prompts.append(f"{base}, clean product design, white background, studio lighting, professional")
        prompts.append(f"{base}, product showcase, minimalist style, white background, commercial")

    # 返回第一个提示词（最常用的）
    return prompts[0]

def generate_ai_image(prompt):
    """使用 AI 服务生成图片"""
    try:
        cmd = f'echo -n "{TOKEN}" | "{PYTHON_EXE}" "{SCRIPT_PATH}" image "{prompt}" --token-stdin --resolution 1024:1024'

        result = subprocess.run(
            cmd,
            shell=True,
            capture_output=True,
            text=True,
            timeout=300
        )

        if result.returncode != 0:
            return None, f"执行失败: {result.stderr[-200:]}"

        # 解析输出
        output_lines = result.stdout.strip().split('\n')
        for line in output_lines:
            if line.strip().startswith('{'):
                try:
                    data = json.loads(line.strip())
                    if 'result_url' in data and data['result_url']:
                        return data['result_url'][0], None
                    if 'error' in data:
                        return None, f"API错误: {data.get('message', 'Unknown error')}"
                except:
                    continue

        return None, "无法解析结果"

    except subprocess.TimeoutExpired:
        return None, "生成超时"
    except Exception as e:
        return None, f"异常: {str(e)}"

def download_image(url, output_path):
    """下载图片到本地"""
    try:
        cmd = f'curl -sS -L -o "{output_path}" "{url}"'
        result = subprocess.run(cmd, shell=True, capture_output=True, timeout=60)

        if result.returncode == 0 and os.path.exists(output_path):
            file_size = os.path.getsize(output_path)
            if file_size > 1000:
                return True, file_size

        return False, 0
    except:
        return False, 0

def update_database(product_id, image_path):
    """更新数据库"""
    try:
        conn = sqlite3.connect(DB_PATH)
        cursor = conn.cursor()
        cursor.execute('''
            UPDATE products
            SET image = ?, hero_image = ?
            WHERE id = ?
        ''', (image_path, image_path, product_id))
        conn.commit()
        conn.close()
        return True
    except:
        return False

def process_product(product_id, product_name, product_slug, category_name, batch_num):
    """处理单个产品"""
    print(f"[批{batch_num:2d}] {product_name[:40]:<40}", end=" ... ")

    # 生成提示词
    prompt = generate_prompt(product_name, category_name)
    print(f"\n      提示词: {prompt[:60]}...", end="")

    # 生成 AI 图片
    image_url, error = generate_ai_image(prompt)

    if not image_url:
        print(f" ✗ {error}\n", end="")
        return False

    print(f" ✓", end="")

    # 下载图片
    filename = f"{product_slug}.png"
    output_path = os.path.join(IMAGES_DIR, filename)
    image_path = f"/images/products/{filename}"

    ok, file_size = download_image(image_url, output_path)

    if not ok:
        print(f" ✗ 下载失败\n", end="")
        return False

    print(f" ({file_size/1024:.0f}KB)", end="")

    # 更新数据库
    if update_database(product_id, image_path):
        print(f" ✓")
        return True
    else:
        print(f" ✗ 数据库更新失败")
        return False

def main():
    print("=" * 70)
    print("AI 批量生成产品图片")
    print("=" * 70)
    print("\n特点:")
    print("  ✓ 根据产品名称生成匹配的 AI 图片")
    print("  ✓ 每张图片都是独特的产品展示")
    print("  ✓ 完全匹配产品描述")
    print("  ⚠️  生成速度较慢 (每个约 20-30 秒)")
    print("  ⚠️  预计总耗时: 30-50 分钟 (96 个产品)")
    print()

    # 获取所有产品
    products = get_all_products()
    total = len(products)

    print(f"总共 {total} 个产品需要生成 AI 图片")
    print()

    # 解析命令行参数
    start_id = 1
    count = total

    if len(sys.argv) > 1:
        for i, arg in enumerate(sys.argv):
            if arg == '--start-id' and i + 1 < len(sys.argv):
                start_id = int(sys.argv[i + 1])
            if arg == '--count' and i + 1 < len(sys.argv):
                count = int(sys.argv[i + 1])

    # 筛选产品
    products = [p for p in products if p[0] >= start_id][:count]
    batch_total = len(products)

    print(f"本次处理: 从 ID {start_id} 开始，共 {batch_total} 个产品")
    print(f"{'=' * 70}\n")

    success = 0
    failed = 0

    for i, (product_id, product_name, product_slug, category_name) in enumerate(products, 1):
        if process_product(product_id, product_name, product_slug, category_name, i):
            success += 1
        else:
            failed += 1

        # 避免请求过快
        if i < batch_total:
            time.sleep(3)  # 每次生成后等待 3 秒

        # 每 10 个产品显示进度
        if i % 10 == 0:
            print(f"\n*** 进度: {i}/{batch_total} ({i/batch_total*100:.0f}%) ***\n")
            # 暂停一下避免 API 限流
            if i < batch_total - 1:
                print("    暂停 30 秒避免限流...\n")
                time.sleep(30)

    # 完成统计
    print(f"\n{'=' * 70}")
    print(f"完成!")
    print(f"{'=' * 70}")
    print(f"成功: {success}")
    print(f"失败: {failed}")
    print(f"总计: {batch_total}")
    print(f"{'=' * 70}\n")

    if success > 0:
        print(f"✓ 成功为 {success} 个产品生成 AI 图片")
        print(f"✓ 图片保存在: {IMAGES_DIR}")
        print(f"✓ 数据库已更新")

if __name__ == '__main__':
    main()
