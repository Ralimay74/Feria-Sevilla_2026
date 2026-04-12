FROM php:8.2-fpm

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

# Instalar dependencias SIN extensiones platform (para evitar errores)
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

# Generar key si no existe
RUN php artisan key:generate --force

# Permisos
RUN chmod -R 777 storage bootstrap/cache

# Nginx config
COPY nginx.conf /etc/nginx/sites-available/default

# Puerto
EXPOSE 8080

# Script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
