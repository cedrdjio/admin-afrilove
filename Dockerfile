# AfriLove World — conteneur PHP (admin)
# Image légère : PHP 8.2 + extension mysqli. Sert l'app via le serveur PHP intégré.
FROM php:8.2-cli

# Extensions nécessaires (mysqli pour la base)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

WORKDIR /app
COPY . /app

# Railway / Render fournissent $PORT ; défaut 8080 en local
ENV PORT=8080
EXPOSE 8080

# Upload d'images plus permissif
RUN echo "upload_max_filesize=20M\npost_max_size=25M\nmemory_limit=256M" > /usr/local/etc/php/conf.d/afrilove.ini

# Lance le serveur PHP intégré (l'app utilise des liens .php directs, pas de réécriture d'URL)
CMD php -S 0.0.0.0:${PORT} -t /app
