# Используем базовый образ PHP 8.1 с Apache
FROM php:8.1-apache

# Установка зависимостей: libmariadb-dev для mysqli и iputils-ping для команды ping
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    iputils-ping \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Настройка Apache: задаем корневую директорию
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Копирование кода приложения
COPY ./public /var/www/html
COPY ./src /var/www/src

# Установка прав для Apache
RUN chown -R www-data:www-data /var/www/html /var/www/src \
    && chmod -R 755 /var/www/html /var/www/src

# Открываем порт
EXPOSE 80