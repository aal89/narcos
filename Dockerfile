FROM aal89/laravel-docker:latest

COPY . .

RUN composer install --optimize-autoloader --no-dev

RUN php artisan route:cache
