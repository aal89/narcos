FROM lorisleiva/laravel-docker:latest

WORKDIR /app

COPY . /app

RUN composer install --optimize-autoloader --no-dev

CMD php artisan serve --host=0.0.0.0 --port=8189

EXPOSE 8189
