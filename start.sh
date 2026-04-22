#!/bin/bash
set -e

# Iniciar PHP-FPM en background
php-fpm -D

# Esperar a que esté listo
until nc -z 127.0.0.1 9000; do
  echo "⏳ Esperando PHP-FPM..."
  sleep 1
done

echo "✅ PHP-FPM listo"

# Iniciar Nginx en foreground
nginx -g "daemon off;"