#!/bin/bash

set -e

# Tạo file .env nếu chưa có
[ ! -f .env ] && cp .env.example .env

# Tạo key cho Laravel
php artisan key:generate

# Chờ DB sẵn sàng
echo "⏳ Waiting for database to be ready..."
until php artisan migrate:status > /dev/null 2>&1; do
  echo "⏳ Still waiting..."
  sleep 2
done

# Kiểm tra bảng scores
COUNT=$(php artisan tinker --execute="try { echo DB::table('scores')->count(); } catch (Exception \$e) { echo -1; }")

if [ "$COUNT" -eq "0" ]; then
  echo "✅ Database is empty. Running migrations and seeders..."
  php artisan migrate --seed
elif [ "$COUNT" -gt "0" ]; then
  echo "✅ Database already has data. Skipping migration."
else
  echo "❌ Could not connect to database or table 'scores' does not exist."
fi
php artisan route:list 
# Khởi động Apache
exec apache2-foreground
