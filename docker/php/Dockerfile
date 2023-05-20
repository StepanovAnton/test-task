FROM php:8.1.19-fpm

WORKDIR /var/www/html

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && docker-php-ext-install zip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копирование файлов проекта
COPY . /var/www/html

# Установка зависимостей PHP
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Установка прав на каталоги
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Генерация ключа приложения
RUN php artisan key:generate

# Конфигурация Nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
RUN rm /etc/nginx/sites-enabled/default

# Конфигурация Supervisor
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Установка прав на каталоги
RUN chmod -R 755 /var/www/html/storage

# Открытие доступа к хранилищу сессий и кеша
RUN chmod -R 777 \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Запуск supervisord
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
