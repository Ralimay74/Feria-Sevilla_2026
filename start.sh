#!/bin/bash

# Crear socket de PHP-FPM si no existe
mkdir -p /var/run/php

# Iniciar PHP-FPM en segundo plano
php-fpm -D

# Esperar a que PHP-FPM esté listo
sleep 2

# Iniciar Nginx en primer plano
nginx -g "daemon off;"
