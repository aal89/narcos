FROM lorisleiva/laravel-docker:latest

WORKDIR /app

COPY . /app

RUN composer install --optimize-autoloader --no-dev

RUN php artisan route:cache

RUN crontab -l | { cat; echo "*      *       *       *       *       cd /app && php artisan schedule:run >> /dev/null 2>&1"; } | crontab -

CMD crond && php artisan serve --host=0.0.0.0 --port=8189

EXPOSE 8189
