FROM php:8.2-fpm

RUN apt update && apt upgrade -y && \
    apt install nano curl bash git zip wget unzip cmake libfreetype6-dev libjpeg62-turbo-dev libpng-dev libpq-dev nginx -y

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/app.com.br

COPY . /var/www/app.com.br
COPY ./docker/nginx/http2/default/ /etc/nginx/sites-enabled/default
COPY ./docker/php/8.2-fpm/entrypoint.sh /etc/entrypoint.sh

RUN chmod +x /etc/entrypoint.sh

COPY --chown=www-data:www-data . /var/www/app.com.br/

RUN composer install && composer dump-autoload

# RUN php artisan migrate && php artisan db:seed RoleSeeder

EXPOSE 80

ENTRYPOINT ["/etc/entrypoint.sh"]

