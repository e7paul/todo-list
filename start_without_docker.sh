composer install --optimize-autoloader &&
touch database/database.sqlite
php artisan config:cache &&
php artisan route:cache &&
php artisan view:cache &&
php artisan migrate --seed --force &&
php artisan serve