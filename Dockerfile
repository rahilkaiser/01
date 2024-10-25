FROM php:7.4-apache

# Systemabhängigkeiten installieren
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev

# PHP-Erweiterungen installieren
RUN docker-php-ext-install mysqli pdo pdo_mysql zip

# Apache-Konfiguration
RUN a2enmod rewrite

# Apache-Konfigurationsdatei kopieren
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Arbeitsverzeichnis setzen
WORKDIR /var/www/html

# Kopieren Sie den src-Inhalt und erstellen Sie das public-Verzeichnis
COPY ./src /var/www/html/src
COPY ./public /var/www/html/public

# Setzen Sie die Berechtigungen
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Apache so konfigurieren, dass es als www-data läuft
RUN sed -i 's/^export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=www-data/' /etc/apache2/envvars \
    && sed -i 's/^export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=www-data/' /etc/apache2/envvars

# Port 80 freigeben
EXPOSE 80

# Apache im Vordergrund starten
CMD ["apache2-foreground"]
