# Usa una imagen base de PHP con Apache
FROM php:8.2-apache

# Instala extensiones de PHP necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia los archivos de tu proyecto al contenedor
COPY . /var/www/html/

# Da permisos a Apache para leer los archivos
RUN chown -R www-data:www-data /var/www/html

# Expon el puerto 80 para el servidor web
EXPOSE 80