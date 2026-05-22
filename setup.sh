#!/bin/bash
# ========================================
# MeisaiPrinting Laravel Deployment Setup
# ========================================
# Run this script after deploying/updating the project
# Usage: bash setup.sh
#
# For Laragon (Windows) users:
#   1. Open Terminal in Laragon
#   2. cd D:\laragon\www\jok2
#   3. bash setup.sh   OR run each command manually

echo "========================================"
echo " MeisaiPrinting Deployment Setup"
echo "========================================"
echo ""

# 1. Install dependencies
echo "[1/7] Installing Composer dependencies..."
composer install --no-interaction --optimize-autoloader 2>/dev/null || echo "  Note: Run 'composer install' manually if this fails"

# 2. Create storage symlink (CRITICAL for image display)
echo ""
echo "[2/7] Creating storage symlink (CRITICAL for images)..."
php artisan storage:link 2>/dev/null || {
    echo "  ⚠️  Could not create symlink automatically."
    echo "  On Windows/Laragon, run this manually in Command Prompt:"
    echo "  cd D:\laragon\www\jok2"
    echo "  php artisan storage:link"
    echo ""
    echo "  If that fails, manually create a shortcut:"
    echo "  1. Open Command Prompt as Administrator"
    echo "  2. mklink /D D:\laragon\www\jok2\public\storage D:\laragon\www\jok2\storage\app\public"
}

# 3. Run migrations
echo ""
echo "[3/7] Running database migrations..."
php artisan migrate --force

# 4. Run database seeder (only for fresh installs)
echo ""
echo "[4/7] Database seeder..."
read -p "  Is this a fresh install? Run seeder? (y/N): " seed_choice
if [[ "$seed_choice" =~ ^[Yy]$ ]]; then
    php artisan db:seed --force
    echo "  ✅ Database seeded with default data"
else
    echo "  Skipping seeder (existing data preserved)"
    # Run the migration to update site_logo default
    echo "  Running setting updates..."
    php artisan migrate --force
fi

# 5. Clear all caches
echo ""
echo "[5/7] Clearing caches..."
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# 6. Create storage directories (in case they don't exist)
echo ""
echo "[6/7] Ensuring storage directories exist..."
mkdir -p storage/app/public/blog
mkdir -p storage/app/public/products
mkdir -p storage/app/public/categories
mkdir -p storage/app/public/inquiries
mkdir -p storage/app/public/brands
mkdir -p storage/app/public/certificates
mkdir -p storage/app/public/team
mkdir -p storage/app/public/settings

# 7. Set permissions (Linux/Mac only, skip on Windows)
echo ""
echo "[7/7] Setting permissions..."
if [[ "$OSTYPE" != "msys" && "$OSTYPE" != "win32" ]]; then
    chmod -R 775 storage
    chmod -R 775 bootstrap/cache
    echo "  ✅ Permissions set"
else
    echo "  On Windows, ensure storage/ directory is writable"
fi

echo ""
echo "========================================"
echo " ✅ Setup complete!"
echo "========================================"
echo ""
echo "📋 Important Notes:"
echo ""
echo "  1. If using MySQL (Laragon), update your .env file:"
echo "     DB_CONNECTION=mysql"
echo "     DB_HOST=127.0.0.1"
echo "     DB_PORT=3306"
echo "     DB_DATABASE=jok2"
echo "     DB_USERNAME=root"
echo "     DB_PASSWORD="
echo ""
echo "  2. Make sure FILESYSTEM_DISK=public in your .env"
echo "     (This is required for uploaded images to display)"
echo ""
echo "  3. Default admin credentials:"
echo "     URL: http://localhost/admin"
echo "     Email: admin@meisaiprinting.com"
echo "     Password: password"
echo ""
echo "  4. After first login, go to 网站设置 to update:"
echo "     - Site Name (网站名称)"
echo "     - Logo (upload or set URL)"
echo "     - Contact information"
echo ""
