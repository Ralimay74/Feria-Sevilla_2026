FROM php:8.2-fpm

# Configurar PHP-FPM para usar puerto TCP en lugar de socket
RUN sed -i 's/listen = .*/listen = 127.0.0.1:9000/' /usr/local/etc/php-fpm.d/www.conf

# Instalar dependencias básicas
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

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos
COPY . .

# Copiar .env.example a .env
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Instalar dependencias
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

# Permisos
RUN chmod -R 777 storage bootstrap/cache

# Optimizar Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Nginx config
COPY nginx.conf /etc/nginx/sites-available/default

# Puerto
EXPOSE 8080

# Script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
