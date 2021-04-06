FROM php:8-cli AS base

###

FROM base AS build-composer

WORKDIR /app

RUN apt update -yqq \
    && apt install -yqq \
        git \
        unzip \
        zip \
    && apt autoremove -yqq

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock /app/
RUN composer install

ENTRYPOINT ["composer"]

###

FROM base AS build

WORKDIR /app

COPY --from=build-composer /app /app

ENTRYPOINT ["bash"]
