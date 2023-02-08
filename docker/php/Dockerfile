FROM php:8.1-fpm

RUN apt update && apt install -y zlib1g-dev g++ git libpq-dev libmcrypt-dev libjpeg62-turbo-dev libicu-dev zip libfreetype6-dev libzip-dev zip curl \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# Composer
WORKDIR /var/www/symfony_docker
RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
RUN php composer-setup.php --install-dir=/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Install Nodejs
RUN curl -sL https://deb.nodesource.com/setup_19.x | bash \
      && apt-get install -y nodejs

# Runtime config
RUN usermod -u 1000 www-data

CMD ["php-fpm"]
