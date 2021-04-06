FROM php:8-cli

WORKDIR /app

ENV PATH=bin:$PATH

RUN apt update -yqq \
    && apt install -yqq \
        git \
        unzip \
        zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock /app/
RUN composer install

COPY . /app
