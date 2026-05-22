#!/usr/bin/env bash
# Render startup script for Laravel

set -e

echo "Starting Laravel application on Render..."

# 1. Generate APP_KEY if empty
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --no-interaction --force
fi

# 2. Create storage directories (Render uses ephemeral filesystem)
mkdir -p storage/{app/public,framework/{cache,sessions,views},logs}
chmod -R 775 storage bootstrap/cache

# 3. Create public/storage symlink (ignore if already exists)
php artisan storage:link --no-interaction 2>/dev/null || true

# 4. Wait for PostgreSQL to be ready (Render DB may take time)
echo "Waiting for database connection..."
MAX_RETRIES=30
COUNTER=0
DB_READY=0

while [ $COUNTER -lt $MAX_RETRIES ] && [ $DB_READY -eq 0 ]; do
    php -r "
        try {
            \$pdo = new PDO('pgsql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
            echo 'connected';
        } catch (Exception \$e) {
            echo 'not_ready';
        }
    " 2>/dev/null | grep -q "connected" && DB_READY=1

    if [ $DB_READY -eq 0 ]; then
        echo "Waiting for database... ($COUNTER/$MAX_RETRIES)"
        sleep 2
    fi
    COUNTER=$((COUNTER + 1))
done

if [ $DB_READY -eq 0 ]; then
    echo "ERROR: Database connection failed after $MAX_RETRIES attempts"
    exit 1
fi

echo "Database is ready!"

# 5. Run migrations (includes TRUNCATE + populate 364 initial records)
echo "Running database migrations (this will reset and populate all data)..."
php artisan migrate --force --no-interaction

echo "Seeding database (no-op: data is handled by migration)..."
php artisan db:seed --force --no-interaction || true

# 6. Optimize Laravel (config, routes, views cache)
echo "Optimizing Laravel..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

# 7. Start PHP built-in server on Render's assigned port
PORT_NUM="${PORT:-10000}"
echo "Starting server on port $PORT_NUM..."
exec php -S 0.0.0.0:$PORT_NUM -t public
