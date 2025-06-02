FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    unzip \
    git \
    && docker-php-ext-install intl pdo_mysql zip mbstring \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p runtime web/assets && chmod -R 777 runtime web/assets

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "web"]
