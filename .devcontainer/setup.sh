#!/bin/bash
set -e

echo "==> Setting up Baricode development environment..."

cd /workspace

# Copy .env jika belum ada
if [ ! -f .env ]; then
  cp .env.example .env
  echo "==> .env created from .env.example"
fi

# Override env untuk koneksi ke service Docker
sed -i 's/DB_HOST=.*/DB_HOST=mysql/' .env
sed -i 's/DB_USERNAME=.*/DB_USERNAME=baricode_user/' .env
sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=userpassword/' .env
sed -i 's/REDIS_HOST=.*/REDIS_HOST=redis/' .env
sed -i 's/REDIS_CLIENT=.*/REDIS_CLIENT=phpredis/' .env

# Install PHP dependencies
echo "==> Installing Composer dependencies..."
composer install --no-interaction --prefer-dist

# Generate app key
echo "==> Generating application key..."
php artisan key:generate --force

# Jalankan migration + seeder
echo "==> Running migrations and seeders..."
php artisan migrate --seed --force

# Install Node dependencies
echo "==> Installing Node.js dependencies..."
npm install

echo ""
echo "======================================"
echo " Setup selesai!"
echo " Jalankan perintah berikut untuk dev:"
echo "   composer run dev"
echo " Atau pisah di terminal berbeda:"
echo "   php artisan serve"
echo "   npm run dev"
echo "   php artisan reverb:start"
echo "   php artisan queue:listen"
echo "======================================"