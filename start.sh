#!/usr/bin/env bash
# Render 启动脚本

set -e

echo "Starting Laravel application on Render..."

# 1. 生成 APP_KEY (如果为空)
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --no-interaction --force
fi

# 2. 创建 storage 目录
mkdir -p storage/app/public
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# 3. 创建 public/storage 软链接（跳过已存在的）
php artisan storage:link --no-interaction 2>/dev/null || true

# 4. 等待数据库就绪 (使用 PHP 直接检测连接)
echo "Waiting for database connection..."
max_retries=30
counter=0
until php -r "
try {
    \$pdo = new PDO(
        'pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'),
        getenv('DB_USERNAME'),
        getenv('DB_PASSWORD'),
        [PDO::ATTR_TIMEOUT => 2]
    );
    exit(0);
} catch (Exception \$e) {
    exit(1);
}
" 2>/dev/null || [ $counter -eq $max_retries ]; do
    echo "Waiting for database... ($counter/$max_retries)"
    sleep 2
    counter=$((counter + 1))
done

if [ $counter -eq $max_retries ]; then
    echo "Database connection failed after $max_retries attempts"
    exit 1
fi

echo "Database is ready!"

# 5. 运行数据库迁移
echo "Running database migrations..."
php artisan migrate --force --no-interaction

# 6. 填充初始数据（幂等，只在首次部署时生效）
echo "Seeding database..."
php artisan db:seed --force --no-interaction || true

# 7. 优化 Laravel
echo "Optimizing Laravel..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

# 8. 启动 PHP 内置服务器，端口由 Render 注入
PORT_NUM="${PORT:-10000}"
echo "Starting PHP server on port $PORT_NUM..."
php artisan serve --host=0.0.0.0 --port="$PORT_NUM"
