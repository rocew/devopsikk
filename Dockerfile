FROM php:8.2-fpm
# Установка драйверов Postgres
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
# Устанавливаем рабочую директорию
WORKDIR /var/www/html
