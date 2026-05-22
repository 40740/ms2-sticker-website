#!/usr/bin/env bash
# Render startup script for Laravel (SQLite mode)

set -e

echo "Starting Laravel application on Render (SQLite)..."

# 1. Generate APP_KEY if empty
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --no-interaction --force
fi

# 2. Create storage directories (Render uses ephemeral filesystem)
mkdir -p storage/{app/public,framework/{cache,sessions,views},logs}
chmod -R 775 storage bootstrap/cache

# 3. Create public/storage symlink (ignore if already exists)
php artisan storage:link --no-interaction 2>/dev/null || true

# 4. Ensure SQLite database file exists (touch so PDO can open it)
DB_PATH="${DB_DATABASE:-/var/www/html/database/render.sqlite}"
touch "$DB_PATH"
chmod 664 "$DB_PATH"
echo "SQLite database ready at $DB_PATH"

# 5. Run migrations (TRUNCATE + populate 364 initial records)
echo "Running database migrations..."
php artisan migrate --force --no-interaction

echo "Seeding database (no-op: data handled by migration)..."
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
