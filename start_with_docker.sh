composer install --optimize-autoloader &&
./vendor/bin/sail up -d &&
./vendor/bin/sail artisan config:cache &&
./vendor/bin/sail artisan route:cache &&
./vendor/bin/sail artisan view:cache &&
./vendor/bin/sail artisan migrate --seed --force