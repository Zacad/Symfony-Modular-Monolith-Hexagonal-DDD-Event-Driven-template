FROM php:8.2-fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

COPY create_test_db.sh /usr/bin/create_test_db

RUN chmod +x /usr/bin/create_test_db


RUN apt-get createView && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev mc sudo default-mysql-client sendmail && \
    pecl install apcu && \
    docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql && \
    docker-php-ext-install -j$(nproc) zip opcache intl && \
    docker-php-ext-enable apcu sodium && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
RUN apt install nodejs

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

RUN echo n | npm install -g --silent sass-loader@^13.0.0 sass --save-dev

RUN  useradd admin && echo "admin:admin" | chpasswd && adduser admin sudo
USER admin

CMD composer i -o ; wait-for-it db:3307  ; create_test_db; php bin/console doctrine:migrations:migrate ; php bin/console doctrine:migrations:migrate --env=test ;  php-fpm

EXPOSE 9000
