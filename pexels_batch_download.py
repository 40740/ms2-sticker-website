#!/usr/bin/env python3
"""
使用 Pexels API 批量下载产品图片
根据产品名称和分类搜索相关图片
"""

import sqlite3
import os
import time
import requests
from pathlib import Path

# 配置
DB_PATH = 'database/database.sqlite'
IMAGES_DIR = 'public/images/products'
PEXELS_API_KEY = 'rTxikRkRj6cpevazPY7miDLK2IRA8acuglLX6CXvfRc9cul4P4Ppkyle'

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

def search_pexels(query):
    """从 Pexels 搜索图片"""
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
        response = requests.get(url, params=params, headers=headers, timeout=15)
        if response.status_code == 200:
            data = response.json()
            if data['photos']:
                photo = data['photos'][0]
                return photo['src']['large'], photo.get('photographer', ''), photo.get('url', '')
        return None, None, None
    except Exception as e:
        print(f"  API 错误: {e}")
        return None, None, None

def download_image(url, output_path):
    """下载图片到本地"""
    try:
        headers = {
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        }
        response = requests.get(url, timeout=30, headers=headers)
        response.raise_for_status()

        with open(output_path, 'wb') as f:
            f.write(response.content)

        file_size = len(response.content)
        return file_size > 1000
    except Exception as e:
        print(f"  下载失败: {e}")
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
        print(f"  更新失败: {e}")
        conn.rollback()
        conn.close()
        return False

def main():
    print("=" * 70)
    print("Pexels API 批量下载产品图片")
    print("=" * 70)

    # 获取所有产品
    products = get_all_products()
    total = len(products)

    print(f"\n总共 {total} 个产品需要处理")
    print("使用 Pexels API 根据产品名称搜索相关图片\n")

    success = 0
    failed = 0
    skipped = 0

    for i, (product_id, product_name, product_slug, category_name) in enumerate(products, 1):
        print(f"[{i:2d}/{total}] {product_name[:35]:<35}", end=" ... ")

        # 生成搜索关键词（更具体）
        search_queries = [
            f"{product_name} sticker label",
            f"{product_name} product",
            f"{category_name} custom",
            f"{product_name}",
        ]

        image_url = None
        photographer = None
        photo_url = None

        # 尝试不同的搜索词
        for query in search_queries:
            url, photog, p_url = search_pexels(query)
            if url:
                image_url = url
                photographer = photog
                photo_url = p_url
                break

            # 限流：Pexels 免费版每秒最多1个请求
            time.sleep(1)

        if not image_url:
            print("✗ 未找到图片")
            failed += 1
            continue

        # 下载图片
        filename = f"{product_slug}.png"
        output_path = os.path.join(IMAGES_DIR, filename)
        image_path = f"/images/products/{filename}"

        if download_image(image_url, output_path):
            # 更新数据库
            if update_product_images(product_id, image_path):
                print(f"✓ ({photographer})")
                success += 1
            else:
                print("✗ (数据库更新失败)")
                failed += 1
        else:
            print("✗ (下载失败)")
            failed += 1

        # Pexels API 限流：每秒1个请求
        time.sleep(1)

    # 完成统计
    print(f"\n{'=' * 70}")
    print(f"完成!")
    print(f"成功: {success}")
    print(f"失败: {failed}")
    print(f"{'=' * 70}\n")

    if success > 0:
        print(f"✓ 成功下载 {success} 个产品图片")
        print(f"✓ 图片保存在: {IMAGES_DIR}")
        print(f"✓ 数据库已更新")

if __name__ == '__main__':
    main()
