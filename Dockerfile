# Usamos una imagen oficial de PHP 8.2
FROM php:8.2-fpm

# Instalar dependencias del sistema y Nginx
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear directorio de trabajo
WORKDIR /var/www/html

# Copiar todo el código de tu proyecto
COPY . .

# Instalar dependencias de PHP (Laravel)
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN php artisan key:generate

# Dar permisos a carpetas necesarias
RUN chmod -R 777 storage bootstrap/cache

# Configuración de Nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Exponer el puerto 8080 (estándar en Render)
EXPOSE 8080

# Script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Ejecutar script al arrancar
CMD ["/start.sh"]
