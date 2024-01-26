FROM php:8.2-fpm

ENV TZ Asia/Tokyo

RUN apt-get update && \
	apt-get install -y git unzip libzip-dev libicu-dev libonig-dev && \
    pecl install redis && \
	docker-php-ext-install intl pdo_mysql zip bcmath && \
    docker-php-ext-enable redis

COPY ./docker/app/php.ini /usr/local/etc/php/php.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app

