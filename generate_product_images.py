#!/usr/bin/env python3
"""
为所有产品生成 AI 图片
- 使用多模态服务生成产品图片
- 保存到 public/images/products/ 目录
- 更新数据库中的 image 和 hero_image 字段
"""

import sqlite3
import os
import json
import requests
from pathlib import Path
import time

# 配置
DB_PATH = 'database/database.sqlite'
IMAGES_DIR = 'public/images/products'
API_BASE_URL = 'https://www.codebuddy.cn/api'  # 需要根据实际的 API endpoint 调整

# 确保图片目录存在
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

def generate_image_prompt(product_name, category_name):
    """根据产品名称和分类生成图片提示词"""
    prompts = {
        'Stickers': f"Professional product photography of custom {product_name}, white background, high quality, commercial style",
        'Labels': f"Professional product photography of {product_name}, elegant design, white background, high quality, commercial style",
        'Packaging': f"Professional product photography of custom {product_name}, creative design, white background, high quality",
        'default': f"Professional product photography of {product_name}, white background, high quality, commercial style"
    }

    # 根据分类选择提示词模板
    if 'Sticker' in category_name:
        return prompts['Stickers']
    elif 'Label' in category_name:
        return prompts['Labels']
    elif 'Packaging' in category_name:
        return prompts['Packaging']
    else:
        return prompts['default']

def generate_image(product_name, category_name):
    """
    使用多模态服务生成图片
    注意：这是一个示例函数，需要根据实际的 API 接口调整
    """
    prompt = generate_image_prompt(product_name, category_name)

    # TODO: 实际调用多模态 API 生成图片
    # 这里需要先了解正确的 API endpoint 和认证方式
    print(f"  提示词: {prompt}")
    print(f"  [TODO] 调用图片生成 API")

    # 临时返回一个占位符
    return None

def download_and_save_image(image_url, product_slug):
    """下载图片并保存到本地"""
    try:
        response = requests.get(image_url, timeout=30)
        response.raise_for_status()

        # 保存图片
        filename = f"{product_slug}.jpg"
        filepath = os.path.join(IMAGES_DIR, filename)

        with open(filepath, 'wb') as f:
            f.write(response.content)

        print(f"  ✓ 图片已保存: {filepath}")
        return f"/images/products/{filename}"

    except Exception as e:
        print(f"  ✗ 下载图片失败: {e}")
        return None

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
        print(f"  ✓ 数据库已更新: product_id={product_id}")
        return True

    except Exception as e:
        print(f"  ✗ 更新数据库失败: {e}")
        conn.rollback()
        return False

    finally:
        conn.close()

def main():
    print("=" * 60)
    print("产品图片生成工具")
    print("=" * 60)

    # 获取需要图片的产品
    products = get_products_without_images()
    print(f"\n找到 {len(products)} 个需要图片的产品\n")

    if len(products) == 0:
        print("所有产品都已经有图片了！")
        return

    # 询问用户是否继续
    print("由于需要生成大量图片，这将消耗较多时间和资源。")
    print("建议先生成前3个产品作为测试。\n")

    # 先处理前3个产品作为测试
    test_products = products[:3]
    print(f"=== 测试模式：生成前 {len(test_products)} 个产品的图片 ===\n")

    for i, (product_id, product_name, product_slug, category_name) in enumerate(test_products, 1):
        print(f"[{i}/{len(test_products)}] 处理产品: {product_name} (ID: {product_id})")
        print(f"  分类: {category_name}")

        # 生成图片
        image_url = generate_image(product_name, category_name)

        # TODO: 当 API 可用时，下载并保存图片
        # if image_url:
        #     image_path = download_and_save_image(image_url, product_slug)
        #     if image_path:
        #         update_product_images(product_id, image_path)

        print()  # 空行
        time.sleep(1)  # 避免 API 限流

    print("=" * 60)
    print("测试完成！")
    print("=" * 60)
    print("\n接下来需要：")
    print("1. 配置正确的图片生成 API endpoint 和认证")
    print("2. 批量生成所有96个产品的图片")
    print("3. 或者考虑使用占位图片（Unsplash/Pexels API）")

if __name__ == '__main__':
    main()
