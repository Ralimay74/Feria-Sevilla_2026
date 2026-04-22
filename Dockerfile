FROM php:8.2-fpm

# Instalar dependencias (incluyendo netcat para el script de inicio)
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    netcat-openbsd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Copiar .env.example si no hay .env
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Instalar dependencias
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

# Permisos (usuario correcto es www-data)
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# 🔧 CORRECCIÓN CLAVE: Modificar www.conf para escuchar en TCP 127.0.0.1:9000
# Eliminamos la línea anterior que creaba docker.conf y usamos esta:
RUN sed -i 's/^listen =.*/listen = 127.0.0.1:9000/' /usr/local/etc/php-fpm.d/www.conf

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