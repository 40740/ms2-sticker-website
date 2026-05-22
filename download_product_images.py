#!/usr/bin/env python3
"""
使用 Unsplash API 批量下载产品图片
- 根据产品名称搜索 Unsplash 免费图片
- 下载并保存到 public/images/products/ 目录
- 更新数据库中的 image 和 hero_image 字段

需要设置环境变量或直接在代码中填入 API Key:
export UNSPLASH_ACCESS_KEY="your-access-key"
"""

import sqlite3
import os
import sys
import time
import requests
from pathlib import Path
from urllib.parse import urlencode

# 配置
DB_PATH = 'database/database.sqlite'
IMAGES_DIR = 'public/images/products'

# Unsplash API 配置 (免费账号每月 50 次请求，演示用)
# 建议申请自己的 API Key: https://unsplash.com/developers
UNSPLASH_ACCESS_KEY = os.environ.get('UNSPLASH_ACCESS_KEY', '')

# 如果没有 API Key，使用 Pexels (免费账号每月 200 次请求)
# 申请 API Key: https://www.pexels.com/api/
PEXELS_API_KEY = os.environ.get('PEXELS_API_KEY', '')

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

def search_unsplash_image(query):
    """从 Unsplash 搜索图片"""
    if not UNSPLASH_ACCESS_KEY:
        return None, "No API Key"

    url = 'https://api.unsplash.com/search/photos'
    params = {
        'query': query,
        'per_page': 1,
        'orientation': 'square'
    }
    headers = {
        'Authorization': f'Client-ID {UNSPLASH_ACCESS_KEY}'
    }

    try:
        response = requests.get(url, params=params, headers=headers, timeout=10)
        if response.status_code == 200:
            data = response.json()
            if data['results']:
                return data['results'][0]['urls']['regular'], None
            return None, "No results"
        else:
            return None, f"API error: {response.status_code}"
    except Exception as e:
        return None, str(e)

def search_pexels_image(query):
    """从 Pexels 搜索图片"""
    if not PEXELS_API_KEY:
        return None, "No API Key"

    url = 'https://api.pexels.com/v1/search'
    params = {
        'query': query,
        'per_page': 1,
        'orientation': 'square'
    }
    headers = {
        'Authorization': PEXELS_API_KEY
    }

    try:
        response = requests.get(url, params=params, headers=headers, timeout=10)
        if response.status_code == 200:
            data = response.json()
            if data['photos']:
                return data['photos'][0]['src']['large'], None
            return None, "No results"
        else:
            return None, f"API error: {response.status_code}"
    except Exception as e:
        return None, str(e)

def search_image_fallback(query):
    """备用方案：使用 DuckDuckGo 图片搜索 (不需要 API Key)"""
    # 使用 Lorem Picsum 提供占位图片
    # 这些是高质量的随机图片
    import hashlib
    # 根据查询生成一个伪随机的 seed
    seed = int(hashlib.md5(query.encode()).hexdigest()[:8], 16) % 1000

    # 使用 picsum.photos (无需 API)
    # 这个服务提供高质量的占位图片
    return f'https://picsum.photos/seed/{seed}/1024/1024', None

def download_image(url, output_path):
    """下载图片到本地"""
    try:
        response = requests.get(url, timeout=30, headers={
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        })
        response.raise_for_status()

        with open(output_path, 'wb') as f:
            f.write(response.content)

        file_size = len(response.content)
        if file_size > 1000:  # 至少 1KB
            print(f"  ✓ 图片已保存: {output_path} ({file_size / 1024:.1f} KB)")
            return True

        return False
    except Exception as e:
        print(f"  ✗ 下载失败: {e}")
        return False

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
        print(f"  ✗ 更新数据库失败: {e}")
        conn.rollback()
        conn.close()
        return False

def process_product(product_id, product_name, product_slug, category_name):
    """处理单个产品"""
    print(f"\n处理: {product_name} ({category_name})")

    # 生成搜索关键词
    query = f"{product_name} {category_name} sticker label"
    print(f"  搜索: {query}")

    image_url = None
    error = None

    # 尝试 Unsplash
    if UNSPLASH_ACCESS_KEY:
        image_url, error = search_unsplash_image(query)
        if image_url:
            print(f"  ✓ 找到 Unsplash 图片")
    else:
        print(f"  - 跳过 Unsplash (无 API Key)")

    # 尝试 Pexels
    if not image_url and PEXELS_API_KEY:
        image_url, error = search_pexels_image(query)
        if image_url:
            print(f"  ✓ 找到 Pexels 图片")
    else:
        print(f"  - 跳过 Pexels (无 API Key)")

    # 使用备用方案
    if not image_url:
        image_url, error = search_image_fallback(query)
        print(f"  ✓ 使用 Lorem Picsum 占位图片")

    if not image_url:
        print(f"  ✗ 搜索失败: {error}")
        return False

    # 下载图片
    filename = f"{product_slug}.png"
    output_path = os.path.join(IMAGES_DIR, filename)
    image_path = f"/images/products/{filename}"

    if not download_image(image_url, output_path):
        return False

    # 更新数据库
    if not update_product_images(product_id, image_path):
        return False

    print(f"  ✓ 完成!")
    return True

def main():
    print("=" * 70)
    print("批量下载产品图片工具 (Unsplash / Pexels / Lorem Picsum)")
    print("=" * 70)

    # 检查 API Key
    print("\nAPI 配置:")
    print(f"  UNSPLASH_ACCESS_KEY: {'✓ 已设置' if UNSPLASH_ACCESS_KEY else '✗ 未设置'}")
    print(f"  PEXELS_API_KEY: {'✓ 已设置' if PEXELS_API_KEY else '✗ 未设置'}")
    if not UNSPLASH_ACCESS_KEY and not PEXELS_API_KEY:
        print("\n⚠️  提示: 将使用 Lorem Picsum 提供占位图片")
        print("   如需真实图片，请申请 API Key:")
        print("   - Unsplash: https://unsplash.com/developers")
        print("   - Pexels: https://www.pexels.com/api/")
        print()

    # 获取产品列表
    products = get_products_without_images()
    total = len(products)

    if total == 0:
        print("\n✓ 所有产品都已经有图片了！")
        return

    print(f"\n找到 {total} 个需要图片的产品")

    # 询问处理方式
    print("\n处理选项:")
    print("  1. 全部处理 (可能会很慢)")
    print("  2. 只处理前 10 个")
    print("  3. 手动输入数量")

    choice = input("\n请选择 (1/2/3): ").strip()

    count = total
    if choice == '2':
        count = min(10, total)
    elif choice == '3':
        try:
            count = int(input(f"请输入数量 (1-{total}): "))
            count = min(max(1, count), total)
        except:
            count = 10

    products = products[:count]

    print(f"\n{'=' * 70}")
    print(f"开始处理 {len(products)} 个产品")
    print(f"{'=' * 70}\n")

    success = 0
    failed = 0

    for i, (product_id, product_name, product_slug, category_name) in enumerate(products, 1):
        print(f"[{i}/{len(products)}]", end="")

        if process_product(product_id, product_name, product_slug, category_name):
            success += 1
        else:
            failed += 1

        # 避免请求过快
        if i < len(products):
            time.sleep(1)

    # 完成统计
    print(f"\n{'=' * 70}")
    print(f"处理完成!")
    print(f"{'=' * 70}")
    print(f"成功: {success}")
    print(f"失败: {failed}")
    print(f"总计: {len(products)}")
    print(f"{'=' * 70}\n")

if __name__ == '__main__':
    main()
