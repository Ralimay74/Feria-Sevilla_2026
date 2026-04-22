FROM php:8.2-fpm

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Copiar .env.example si no hay .env
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Instalar dependencias
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Configurar PHP-FPM para puerto TCP
RUN echo "listen = 127.0.0.1:9000" > /usr/local/etc/php-fpm.d/docker.conf

# Optimizar Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Copiar config de Nginx
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 8080

COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]