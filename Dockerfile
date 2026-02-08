FROM wordpress:php8.2-apache
COPY docker-entrypoint-wp.sh /usr/local/bin/docker-entrypoint-wp.sh
RUN chmod +x /usr/local/bin/docker-entrypoint-wp.sh
ENTRYPOINT ["/usr/local/bin/docker-entrypoint-wp.sh"]
CMD ["apache2-foreground"]
