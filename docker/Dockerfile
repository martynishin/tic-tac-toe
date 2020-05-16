FROM php:7.4-apache

RUN apt-get update \
    && apt-get install -y supervisor zip unzip zlib1g-dev libpng-dev libzip-dev libsodium-dev libxml2-dev libssh-dev

#add php composer to container
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    && composer self-update

#install additional php extensions
RUN docker-php-ext-install gd zip sodium pdo_mysql soap bcmath sockets

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

RUN pecl install xdebug \
    && echo 'zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20190902/xdebug.so' >> /usr/local/etc/php/php.ini

ADD xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

#install and configure supervisord
RUN mkdir -p /var/log/supervisord
ADD supervisord/supervisord.conf /etc/supervisor/supervisord.conf
ADD supervisord/apache2.conf /etc/supervisor/conf.d/apache2.conf
ADD supervisord/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf
ADD supervisord/supercronic.conf /etc/supervisor/conf.d/supercronic.conf

#change default apache2 configuration
RUN a2enmod proxy proxy_http proxy_connect rewrite \
    && rm /etc/apache2/sites-available/default-ssl.conf
ADD ./apache/apache2.conf /etc/apache2/apache2.conf

WORKDIR /var/www/html

CMD ["/usr/bin/supervisord"]

EXPOSE 80
