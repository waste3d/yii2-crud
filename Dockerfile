FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    unzip \
    git \
    && docker-php-ext-install intl pdo_mysql zip mbstring

# Копируем composer из composer образа
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . /app

RUN composer --version
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8080

CMD ["php", "yii", "serve", "--port=8080", "--docroot=web"]
