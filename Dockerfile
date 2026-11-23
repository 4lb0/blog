# syntax=docker/dockerfile:1

# Etapa de dependencias: Composer y su cache no viajan a la imagen final.
FROM alpine:3.21 AS vendor

RUN apk add --no-cache \
        php83 php83-phar php83-openssl php83-mbstring php83-dom \
        php83-xml php83-simplexml php83-tokenizer php83-iconv php83-ctype \
        unzip

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --no-scripts

# Imagen final: alpine + php83 y nada más.
FROM alpine:3.21

RUN apk add --no-cache \
        php83 php83-phar php83-openssl php83-mbstring php83-dom \
        php83-xml php83-simplexml php83-tokenizer php83-iconv php83-ctype

WORKDIR /app
COPY build.php common.php composer.json composer.lock ./
COPY src ./src
COPY templates ./templates
COPY pages ./pages
COPY assets ./assets
COPY --from=vendor /app/vendor ./vendor

RUN mkdir -p /app/public

ENTRYPOINT ["php83", "build.php"]
