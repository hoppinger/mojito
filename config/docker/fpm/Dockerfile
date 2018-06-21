FROM php:7.2-fpm-alpine

RUN apk update && apk add git mysql-client

# install the PHP extensions we need
# postgresql-dev is needed for https://bugs.alpinelinux.org/issues/3642
RUN set -ex \
  && apk add --no-cache --virtual .build-deps \
    coreutils \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    postgresql-dev \
  && docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
  && docker-php-ext-install -j "$(nproc)" \
    gd \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    zip \
  && runDeps="$( \
    scanelf --needed --nobanner --format '%n#p' --recursive /usr/local \
      | tr ',' '\n' \
      | sort -u \
      | awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
  )" \
  && apk add --virtual .drupal-phpexts-rundeps $runDeps \
  && apk del .build-deps

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=60'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
  } > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN cp composer.phar /usr/local/bin/composer

RUN rm -rf /var/www/build
WORKDIR /var/www/build
COPY ./composer.json ./composer.json
COPY ./composer.lock ./composer.lock
COPY ./scripts ./scripts
RUN composer install

WORKDIR /var/www/html

COPY ./config/docker/fpm/init.sh /root/init.sh
RUN chmod +x /root/init.sh

CMD ["/root/init.sh"]