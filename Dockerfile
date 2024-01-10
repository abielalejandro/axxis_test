FROM php:8.2

RUN apt-get update \
    && apt-get install -qq -y --no-install-recommends \
    php-pgsql \
     vim \
     locales coreutils apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev libpq-dev

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv $HOME/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/html
COPY . .

RUN composer install
RUN symfony check:requirements
RUN php bin/console cache:clear
RUN php bin/console doctrine:migrations:migrate

EXPOSE 8000
CMD ["symfony", "server:start"]