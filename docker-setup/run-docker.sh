#!/bin/bash

#docker-compose -f docker-setup/docker-compose.yml build
docker-compose -f docker-compose.yml up -d

#docker exec tv_king_mysql mysql -u root -pabc123 -e "CREATE DATABASE IF EXISTS tv_king_db"
#docker exec tv_king_mysql mysql -u root -pabc123 -e "CREATE DATABASE tv_king_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci"
docker exec php_tv_king php -f /var/www/tv-king/artisan migrate
docker exec php_tv_king php -f /var/www/tv-king/artisan demo:install


