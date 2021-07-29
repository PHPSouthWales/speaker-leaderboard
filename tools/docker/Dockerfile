FROM php:8-cli AS base

###

FROM base AS dev

WORKDIR /app

RUN apt update -yqq \
    && apt install -yqq \
        git \
        unzip \
        zip \
    && apt autoremove -yqq

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY composer.json .
COPY composer.lock .
RUN composer validate --strict
RUN composer install
COPY . .

###

FROM dev AS app

ENTRYPOINT ["bin/console"]
CMD ["php-south-wales:generate-leaderboard"]
