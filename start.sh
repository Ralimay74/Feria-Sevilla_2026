#!/bin/bash

# Iniciar PHP-FPM
php-fpm &

# Iniciar Nginx en primer plano (para que el contenedor no se cierre)
nginx -g "daemon off;"
