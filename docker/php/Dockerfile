FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev libicu-dev gnupg \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd pdo_mysql mbstring zip exif pcntl bcmath intl opcache \
  && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ARG WITH_XDEBUG=false
RUN if [ "$WITH_XDEBUG" = "true" ]; then \
      pecl install xdebug && docker-php-ext-enable xdebug; \
    fi

RUN useradd -u 1000 -g www-data -m user

WORKDIR /var/www/html
