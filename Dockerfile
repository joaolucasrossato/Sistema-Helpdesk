FROM php:8.4-cli

# Instala dependências do sistema e extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Gera a chave da aplicação e otimiza configs no build
RUN php artisan config:clear

EXPOSE 10000

CMD php artisan migrate --force && php artisan db:seed --force --class=DatabaseSeeder && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
