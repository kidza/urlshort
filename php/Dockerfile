FROM php:8.0-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip librabbitmq-dev libssl-dev \
    && docker-php-ext-install intl opcache pdo pdo_mysql  \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# AMQP
RUN apt-get update \
	&& apt-get install -y -f librabbitmq-dev \
		libssh-dev \
	&& docker-php-source extract \
	&& mkdir /usr/src/php/ext/amqp \
	&& curl -L https://github.com/php-amqp/php-amqp/archive/master.tar.gz | tar -xzC /usr/src/php/ext/amqp --strip-components=1 \
	&& docker-php-ext-install amqp \
	&& docker-php-ext-enable amqp

WORKDIR /var/www/project

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony


#COPY app/composer.json app/
#COPY app/composer.lock app/
#
#RUN cd ./app && composer install --no-interaction --no-scripts
