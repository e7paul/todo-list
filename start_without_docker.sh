composer install --optimize-autoloader &&
php -r "fopen('database/database.sqlite', 'w');" &&
php -r "fwrite(fopen('.env', 'w'), 'APP_KEY=' . PHP_EOL . 'DB_CONNECTION=sqlite' . PHP_EOL . 'DB_DATABASE=database.sqlite');" &&
php artisan key:generate &&
php artisan config:cache &&
php artisan route:cache &&
php artisan view:cache &&
php artisan migrate --seed --force &&
php artisan serve