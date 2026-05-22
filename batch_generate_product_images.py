#!/usr/bin/env python3
"""
批量生成产品 AI 图片
- 为每个没有图片的产品生成 AI 图片
- 自动下载并保存到 public/images/products/ 目录
- 更新数据库中的 image 和 hero_image 字段
- 支持断点续传
"""

import sqlite3
import os
import sys
import json
import time
import subprocess
from pathlib import Path
from datetime import datetime

# 配置
DB_PATH = 'database/database.sqlite'
IMAGES_DIR = 'public/images/products'
SCRIPT_DIR = 'D:/Program Files/WorkBuddy/resources/app.asar.unpacked/resources/builtin-skills/buddy-multimodal-generation/scripts'
PYTHON_EXE = 'C:/Users/lin85/AppData/Local/Programs/Python/Python311/python.exe'
BUDDY_SCRIPT = os.path.join(SCRIPT_DIR, 'buddy-cloud.py')

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

def generate_image_prompt(product_name, category_name):
    """根据产品名称和分类生成图片提示词"""
    # 基础模板
    base_prompt = f"Professional product photography of {product_name}, "

    # 根据分类添加风格关键词
    if 'Sticker' in category_name:
        style = "vibrant colors, die-cut shape, white background, commercial style, high quality"
        if 'Holographic' in product_name:
            style = "iridescent rainbow holographic effect, white background, commercial style, high quality"
    elif 'Label' in category_name:
        style = "elegant design, bottle label mockup, white background, commercial style, high quality"
    elif 'Packaging' in category_name:
        style = "creative design, packaging mockup, white background, commercial style, high quality"
    else:
        style = "white background, commercial style, high quality"

    return base_prompt + style

def generate_image(token, prompt, output_path):
    """使用多模态服务生成图片"""
    try:
        # 构造命令
        cmd = f'echo -n "{token}" | "{PYTHON_EXE}" "{BUDDY_SCRIPT}" image "{prompt}" --token-stdin --resolution 1024:1024'

        # 执行命令
        result = subprocess.run(
            cmd,
            shell=True,
            capture_output=True,
            text=True,
            timeout=300  # 5分钟超时
        )

        if result.returncode != 0:
            print(f"  ✗ 生成失败: {result.stderr}")
            return None

        # 解析输出（JSON）
        output_lines = result.stdout.strip().split('\n')
        for line in output_lines:
            if line.strip().startswith('{'):
                data = json.loads(line.strip())
                if 'result_url' in data:
                    return data['result_url'][0]  # 返回第一个 URL

        print(f"  ✗ 无法解析生成结果")
        return None

    except subprocess.TimeoutExpired:
        print(f"  ✗ 生成超时")
        return None
    except Exception as e:
        print(f"  ✗ 生成失败: {e}")
        return None

def download_image(url, output_path):
    """下载图片到本地"""
    try:
        cmd = f'curl -sS -L -o "{output_path}" "{url}"'
        result = subprocess.run(cmd, shell=True, capture_output=True, timeout=60)

        if result.returncode == 0 and os.path.exists(output_path):
            file_size = os.path.getsize(output_path)
            if file_size > 0:
                print(f"  ✓ 图片已保存: {output_path} ({file_size / 1024:.1f} KB)")
                return True

        print(f"  ✗ 下载失败")
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
        return True

    except Exception as e:
        print(f"  ✗ 更新数据库失败: {e}")
        conn.rollback()
        return False

    finally:
        conn.close()

def main():
    print("=" * 70)
    print("批量产品图片生成工具")
    print("=" * 70)

    # 检查依赖
    if not os.path.exists(BUDDY_SCRIPT):
        print(f"✗ 错误: 找不到 buddy-cloud.py 脚本: {BUDDY_SCRIPT}")
        sys.exit(1)

    # 获取需要图片的产品
    products = get_products_without_images()
    total = len(products)

    if total == 0:
        print("\n✓ 所有产品都已经有图片了！")
        return

    print(f"\n找到 {total} 个需要图片的产品")
    print(f"预计耗时: {total * 30 / 60:.1f} - {total * 45 / 60:.1f} 分钟\n")

    # 确认是否继续
    response = input("是否开始批量生成？(y/n): ")
    if response.lower() != 'y':
        print("已取消")
        return

    # 获取 token
    print("\n正在获取认证 token...")
    print("（需要调用 connect_cloud_service 工具）")
    print("请在另一个终端执行此操作，或手动输入 token\n")

    token = input("请输入 tempToken: ").strip()
    if not token:
        print("✗ Token 不能为空")
        sys.exit(1)

    # 批量生成
    print(f"\n{'=' * 70}")
    print(f"开始批量生成 {total} 个产品的图片")
    print(f"{'=' * 70}\n")

    success_count = 0
    failed_count = 0

    for i, (product_id, product_name, product_slug, category_name) in enumerate(products, 1):
        print(f"[{i}/{total}] 处理产品: {product_name} (ID: {product_id})")
        print(f"  分类: {category_name}")

        # 生成图片提示词
        prompt = generate_image_prompt(product_name, category_name)
        print(f"  提示词: {prompt[:80]}...")

        # 生成图片
        image_url = generate_image(token, prompt, None)
        if not image_url:
            print(f"  ✗ 生成失败，跳过此产品\n")
            failed_count += 1
            continue

        # 下载图片
        filename = f"{product_slug}.png"
        output_path = os.path.join(IMAGES_DIR, filename)
        image_path = f"/images/products/{filename}"

        if not download_image(image_url, output_path):
            print(f"  ✗ 下载失败，跳过此产品\n")
            failed_count += 1
            continue

        # 更新数据库
        if not update_product_images(product_id, image_path):
            print(f"  ✗ 数据库更新失败\n")
            failed_count += 1
            continue

        print(f"  ✓ 完成!")
        success_count += 1

        # 避免 API 限流
        if i < total:
            wait_time = 5
            print(f"  等待 {wait_time} 秒...")
            time.sleep(wait_time)
            print()

        # 每 10 个产品休息一下
        if i % 10 == 0 and i < total:
            print(f"\n*** 已处理 {i}/{total}，休息 30 秒... ***\n")
            time.sleep(30)

    # 完成统计
    print(f"\n{'=' * 70}")
    print(f"批量生成完成！")
    print(f"{'=' * 70}")
    print(f"成功: {success_count}")
    print(f"失败: {failed_count}")
    print(f"总计: {total}")
    print(f"{'=' * 70}\n")

if __name__ == '__main__':
    main()
