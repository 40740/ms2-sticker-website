#!/usr/bin/env bash
# Render 启动脚本

set -e

echo "🚀 Starting Laravel application on Render..."

# 1. 生成 APP_KEY (如果为空)
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --no-interaction --force
fi

# 2. 创建 storage 目录 (Render 临时文件系统)
mkdir -p storage/app/public
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
chmod -R 755 storage

# 3. 创建 public/storage 软链接
if [ ! -L public/storage ]; then
    php artisan storage:link --no-interaction || true
fi

# 4. 等待数据库就绪 (重要！)
echo "⏳ Waiting for database connection..."
max_retries=30
counter=0
until php artisan db:monitor --timeout=2 --retries=1 2>/dev/null || [ $counter -eq $max_retries ]; do
    echo "Waiting for database... ($counter/$max_retries)"
    sleep 2
    ((counter++))
done

if [ $counter -eq $max_retries ]; then
    echo "❌ Database connection failed after $max_retries attempts"
    exit 1
fi

echo "✅ Database is ready!"

# 5. 运行数据库迁移
echo "🔄 Running database migrations..."
php artisan migrate --force --no-interaction

# 6. 优化 Laravel
echo "⚡ Optimizing Laravel..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

# 7. 启动 Nginx + PHP-FPM
echo "🌐 Starting web server..."
# Render 使用 Apache (via apt-get install apache2)
# 但 PHP 内置服务器更简单
php artisan serve --host=0.0.0.0 --port=${PORT:-80} &
nginx -g "daemon off;"
