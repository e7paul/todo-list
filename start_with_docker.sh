composer install --optimize-autoloader &&
./vendor/bin/sail up -d &&
./vendor/bin/sail php -r "fopen('database/database.sqlite', 'w');" &&
./vendor/bin/sail php -r "fwrite(fopen('.env', 'w'), 'APP_KEY=');" &&
./vendor/bin/sail artisan key:generate &&
./vendor/bin/sail artisan config:cache &&
./vendor/bin/sail artisan route:cache &&
./vendor/bin/sail artisan view:cache &&
./vendor/bin/sail artisan migrate --seed --force