composer install --optimize-autoloader &&
touch database/database.sqlite
./vendor/bin/sail up -d &&
./vendor/bin/sail artisan config:cache &&
./vendor/bin/sail artisan route:cache &&
./vendor/bin/sail artisan view:cache &&
./vendor/bin/sail artisan migrate:fresh --seed --force