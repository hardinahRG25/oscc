FROM php:8-fpm-alpine
RUN \
  apk update && \
  apk upgrade && \
  apk add --update linux-headers && \
  apk add ${PHPIZE_DEPS} oniguruma-dev openssl-dev curl-dev icu-dev

RUN docker-php-ext-install pdo_mysql mysqli intl curl

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- \
  &&  mv composer.phar /usr/local/bin/composer 

RUN ln -sf /bin/bash /bin/ash
RUN adduser toto -D
USER toto
