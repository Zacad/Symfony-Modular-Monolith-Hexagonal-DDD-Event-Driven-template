#!/bin/sh

# DROP DATABASE
php bin/console doctrine:database:drop --force

# CREATE DATABASE
php bin/console doctrine:database:create

# RUN MIGRATIONS
php bin/console doctrine:migrations:migrate --no-interaction

# DROP DATABASE
php bin/console doctrine:database:drop --force --env=test

# CREATE DATABASE
php bin/console doctrine:database:create --env=test

# RUN MIGRATIONS
php bin/console doctrine:migrations:migrate --no-interaction --env=test