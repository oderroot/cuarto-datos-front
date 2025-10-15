FROM php:7.4.29-apache
RUN dnf update && \
    dnf install -y \
        zlib1g-dev
COPY cert/cert.crt /etc/apache2/ssl/cert.crt
COPY cert/private.key /etc/apache2/ssl/private.key
COPY conf/dev.conf /etc/apache2/sites-enabled/dev.conf
RUN a2enmod rewrite
RUN a2enmod ssl
RUN service apache2 restart