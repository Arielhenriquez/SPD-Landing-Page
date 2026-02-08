#!/bin/bash
# Permite que Duplicator cree el archivo CSRF en dup-installer
if [ -d /var/www/html/dup-installer ]; then
  chmod -R 775 /var/www/html/dup-installer
  chown -R www-data:www-data /var/www/html/dup-installer 2>/dev/null || true
fi
exec /usr/local/bin/docker-entrypoint.sh apache2-foreground
