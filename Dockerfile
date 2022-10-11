FROM php:8.1-apache

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y git
RUN apt-get install -y zip unzip libzip-dev libssl-dev librabbitmq-dev postgresql libpq-dev supervisor cron
RUN docker-php-ext-install zip pdo pdo_pgsql

RUN pecl install amqp
RUN docker-php-ext-enable amqp

# And copy the PHP code ...
RUN mkdir -p /var/www/service
COPY ./service /var/www/service


RUN mkdir -p /var/www/service/var/log
RUN mkdir -p /var/www/service/var/cache
RUN touch /var/log/prod.log
RUN touch /var/log/dev.log

RUN chown www-data:www-data /var/log/prod.log
RUN chown www-data:www-data /var/log/dev.log
RUN chown www-data:www-data -R /var/www/service/var/log
RUN chown www-data:www-data -R /var/www/service/var/cache

RUN chmod 777 /var/log/prod.log
RUN chmod 777 /var/log/dev.log

# Select service folder like a work directiory
WORKDIR /var/www/service

# Install the PHP composer
RUN curl -sS https://getcomposer.org/installer | php -- --quiet --install-dir=/usr/local/bin --filename=composer --version=2.4.2 #updatecomposer

# Install PHP dependencies and update the autoloader
RUN php /usr/local/bin/composer install


# COPY SUPERVISOR CONF FILES AND RUN
COPY service/config/build/messenger-worker.conf /etc/supervisor/conf.d/messenger-worker.conf
COPY service/config/build/apache-worker.conf /etc/supervisor/conf.d/apache-worker.conf
COPY service/config/build/supervisord.conf /etc/supervisor/supervisord.conf
COPY service/config/build/api.conf /etc/apache2/sites-available/000-default.conf

# ENABLE MOD_REWRITE IN APACHE
RUN a2enmod rewrite

CMD ["/usr/bin/supervisord"]