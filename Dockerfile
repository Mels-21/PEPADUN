FROM php:8.2-apache

# Enable Apache Rewrite Module (dibutuhkan untuk routing CodeIgniter)
RUN a2enmod rewrite

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Update konfigurasi Apache agar .htaccess CodeIgniter terbaca
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy semua file project ke dalam container
COPY . /var/www/html/

# Set permission agar web server bisa menulis file (misal untuk folder uploads atau logs CodeIgniter)
RUN chown -R www-data:www-data /var/www/html

# Configure Apache to listen on Railway's PORT environment variable
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
RUN sed -i 's/:80/:${PORT}/g' /etc/apache2/sites-available/000-default.conf
