FROM php:8.1-apache

# Установка зависимостей и расширения mysqli
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Настройка Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Копирование кода приложения
COPY ./public /var/www/html
COPY ./src /var/www/src

# Установка прав
RUN chown -R www-data:www-data /var/www/html /var/www/src