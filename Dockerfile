FROM "wordpress:${WP_VERSION:-latest}"

RUN apt-get update -y \
  && apt-get install -y \
      libxml2-dev \
      vim \
  && apt-get clean -y \
  && docker-php-ext-install soap  \
  && docker-php-ext-enable soap

# Replace php.ini
# COPY php.ini /usr/local/etc/php
