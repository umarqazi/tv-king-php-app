FROM php:7.2-apache

RUN mkdir -p /var/www/tv-king
WORKDIR /var/www/tv-king

RUN apt-get update \
	&& apt-get install -y vim git libmcrypt-dev libfreetype6-dev libxslt-dev \
	libjpeg62-turbo-dev \
	libpng-dev unzip zip \
	&& rm -rf /var/lib/apt/lists/* \
	&& pecl install mcrypt-1.0.1 \
	&& docker-php-ext-install pdo_mysql xsl zip intl \
	&& docker-php-ext-install mysqli exif \
	&& docker-php-ext-enable mcrypt \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD composer*.json .

COPY . .

RUN /usr/local/bin/composer install --optimize-autoloader --no-dev

COPY docker-setup/docker.env .env

RUN chown -R www-data:www-data \
        /var/www/tv-king/storage \
        /var/www/tv-king/bootstrap/cache

#RUN php artisan optimize
RUN php artisan config:cache

RUN a2enmod rewrite headers expires negotiation
RUN service apache2 restart

