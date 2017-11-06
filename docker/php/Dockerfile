FROM php:7.0-apache

# Installs php extensions
RUN apt-get update \
  && apt-get install -y \
      git \
      vim \
      wget \
      apt-utils \
      locales \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libmcrypt-dev \
      libpng12-dev \
      mysql-client \
      libcurl3 \
      libcurl3-dev \
      libxml2-dev \
      libicu-dev \
      zlib1g-dev \
      nodejs \
      npm \
  && apt-get clean \
  && rm -r /var/lib/apt/lists/* \
  && rm -rf /tmp/pear

RUN ln -s /usr/bin/nodejs /usr/local/bin/node
RUN ln -s /usr/bin/npm /usr/local/bin/npm

RUN npm cache clean -f
RUN npm install -g n
#Node 
RUN n 7.*

RUN npm install npm@latest -g

RUN docker-php-ext-install mcrypt gd curl pdo_mysql mbstring mysqli soap opcache intl zip sockets \
    && pecl install xdebug

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin \
    && composer global require "hirak/prestissimo:^0.3"

# Configuration
RUN a2enmod rewrite ssl headers

COPY vhost.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/php.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY run.sh /usr/local/bin/run.sh


# Add www-data to root group and viceversa
RUN usermod -u 1000 www-data

# Change ownership of www-data root directory
RUN chown -R www-data:www-data /var/www

# Custom PHP ini configuration
COPY php.ini /usr/local/etc/php/conf.d/

WORKDIR /var/www/app

# Start!
COPY ./run.sh /
RUN chmod +x /run.sh
HEALTHCHECK --interval=5m --timeout=3s \ 
   CMD ["/run.sh"]
