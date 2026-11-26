# syntax=docker/dockerfile:1

# Etapa de dependencias: Composer y su cache no viajan a la imagen final.
FROM alpine:3.21 AS vendor

RUN apk add --no-cache \
        php84 php84-phar php84-openssl php84-mbstring php84-dom \
        php84-xml php84-simplexml php84-tokenizer php84-iconv php84-ctype \
        php84-fileinfo \
        unzip \
    && ln -s /usr/bin/php84 /usr/local/bin/php

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --no-scripts

# Imagen final: alpine + php84 y nada más.
FROM alpine:3.21

RUN apk add --no-cache \
        php84 php84-phar php84-openssl php84-mbstring php84-dom \
        php84-xml php84-simplexml php84-tokenizer php84-iconv php84-ctype \
        php84-fileinfo \
    && ln -s /usr/bin/php84 /usr/local/bin/php

WORKDIR /app
COPY build.php common.php composer.json composer.lock ./
COPY src ./src
COPY templates ./templates
COPY pages ./pages
COPY assets ./assets
COPY --from=vendor /app/vendor ./vendor

RUN mkdir -p /app/public

ENTRYPOINT ["php84", "build.php"]
