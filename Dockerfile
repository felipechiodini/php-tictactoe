FROM phpswoole/swoole:php8.4

WORKDIR /var/www

COPY . /var/www

EXPOSE 9501

RUN docker-php-ext-install mysqli pdo_mysql