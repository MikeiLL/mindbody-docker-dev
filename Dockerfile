FROM "wordpress:${WP_VERSION:-5.5.1}-php${PHP_VERSION:-7.3}-apache"

RUN apt-get update -y \
  && apt-get install -y \
      libxml2-dev \
      vim \
  && apt-get clean -y \
  && docker-php-ext-install soap  \
  && docker-php-ext-enable soap \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug

COPY docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d
