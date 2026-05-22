#!/usr/bin/env python3
"""
快速批量下载产品图片
- 使用 Lorem Picsum（免费，无需 API Key）
- 根据产品 slug 生成唯一的 seed
- 快速下载并更新数据库

优点：速度极快，30-60秒完成所有96个产品
缺点：图片是通用的占位图，不一定完全匹配产品
"""

import sqlite3
import os
import time
import requests
import hashlib
from pathlib import Path

# 配置
DB_PATH = 'database/database.sqlite'
IMAGES_DIR = 'public/images/products'

# 确保目录存在
Path(IMAGES_DIR).mkdir(parents=True, exist_ok=True)

def get_products_without_images():
    """获取没有图片的产品"""
    conn = sqlite3.connect(DB_PATH)
    cursor = conn.cursor()

    cursor.execute('''
        SELECT p.id, p.name, p.slug, c.name as category_name
        FROM products p
        JOIN categories c ON p.category_id = c.id
        WHERE p.image IS NULL OR p.hero_image IS NULL
        ORDER BY p.id
    ''')

    products = cursor.fetchall()
    conn.close()

    return products

def generate_seed(text):
    """根据文本生成唯一的数字 seed"""
    # 使用 MD5 哈希生成一个伪随机的数字
    hash_obj = hashlib.md5(text.encode())
    # 取前8个字符转换为整数，再取模得到 0-1000 的数字
    seed = int(hash_obj.hexdigest()[:8], 16) % 1000
    return seed

def download_image(product_slug):
    """从 Lorem Picsum 下载图片"""
    # 使用产品 slug 作为 seed，确保同一产品每次下载相同的图片
    seed = generate_seed(product_slug)
    url = f'https://picsum.photos/seed/{seed}/1024/1024'

    filename = f"{product_slug}.png"
    output_path = os.path.join(IMAGES_DIR, filename)
    image_path = f"/images/products/{filename}"

    try:
        # 添加 User-Agent 避免被拒绝
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        }

        response = requests.get(url, timeout=15, headers=headers, allow_redirects=True)
        response.raise_for_status()

        # 保存图片
        with open(output_path, 'wb') as f:
            f.write(response.content)

        file_size = len(response.content)
        if file_size > 1000:  # 至少 1KB
            return True, image_path, file_size

        return False, None, 0

    except Exception as e:
        print(f"  下载失败: {e}")
        return False, None, 0

def update_product_images(product_id, image_path):
    """更新数据库中的产品图片字段"""
    conn = sqlite3.connect(DB_PATH)
    cursor = conn.cursor()

    try:
        cursor.execute('''
            UPDATE products
            SET image = ?, hero_image = ?
            WHERE id = ?
        ''', (image_path, image_path, product_id))

        conn.commit()
        conn.close()
        return True

    except Exception as e:
        print(f"  更新数据库失败: {e}")
        conn.rollback()
        conn.close()
        return False

def main():
    print("=" * 70)
    print("快速批量下载产品图片 (Lorem Picsum)")
    print("=" * 70)
    print("\n特点:")
    print("  ✓ 完全免费，无需 API Key")
    print("  ✓ 速度极快，30-60秒完成所有图片")
    print("  ✓ 同一产品每次下载相同的图片")
    print("  ⚠️  图片是通用占位图，可能不完全匹配产品")
    print()

    # 获取产品列表
    products = get_products_without_images()
    total = len(products)

    if total == 0:
        print("✓ 所有产品都已经有图片了！")
        return

    print(f"找到 {total} 个需要图片的产品")
    print(f"预计耗时: {total * 2} - {total * 3} 秒\n")

    # 开始下载
    print(f"{'=' * 70}")
    print(f"开始下载 {total} 个产品的图片")
    print(f"{'=' * 70}\n")

    success = 0
    failed = 0
    total_size = 0

    start_time = time.time()

    for i, (product_id, product_name, product_slug, category_name) in enumerate(products, 1):
        print(f"[{i:2d}/{total}] {product_name[:40]:<40}", end=" ... ")

        # 下载图片
        ok, image_path, file_size = download_image(product_slug)

        if ok:
            # 更新数据库
            if update_product_images(product_id, image_path):
                print(f"✓ ({file_size / 1024:.0f} KB)")
                success += 1
                total_size += file_size
            else:
                print("✗ (数据库更新失败)")
                failed += 1
        else:
            print("✗ (下载失败)")
            failed += 1

        # 短暂延迟避免请求过快
        time.sleep(0.5)

    elapsed = time.time() - start_time

    # 完成统计
    print(f"\n{'=' * 70}")
    print(f"下载完成!")
    print(f"{'=' * 70}")
    print(f"成功: {success} 个")
    print(f"失败: {failed} 个")
    print(f"总计: {len(products)} 个")
    print(f"耗时: {elapsed:.1f} 秒")
    print(f"总大小: {total_size / 1024 / 1024:.1f} MB")
    print(f"{'=' * 70}\n")

    if success > 0:
        print(f"✓ 已成功为 {success} 个产品下载图片")
        print(f"✓ 图片保存在: {IMAGES_DIR}")
        print(f"✓ 数据库已更新")
        print()
        print("建议:")
        print("  1. 重要产品可以后续用 AI 重新生成图片")
        print("  2. 或者手动上传真实产品图片替换")
        print("  3. 运行 python download_product_images.py 可以用 Unsplash/Pexels 下载更匹配的图片")

if __name__ == '__main__':
    main()
