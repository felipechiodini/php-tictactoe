FROM phpswoole/swoole:php8.4-alpine

WORKDIR /var/www

COPY . /var/www

RUN docker-php-ext-install pdo_mysql