#!/bin/bash

docker-compose -f docker-setup/docker-compose.yml build
docker-compose -f docker-setup/docker-compose.yml up -d

docker exec php_tv_king php -f /var/www/tv-king/artisan migrate
docker exec php_tv_king php -f /var/www/tv-king/artisan demo:install


