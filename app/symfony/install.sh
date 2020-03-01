#!/bin/bash

# install dependencies
composer install

php bin/console cache:clear

# Create database + update schema
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# Update var directory permissions
chown -R www-data: var/
