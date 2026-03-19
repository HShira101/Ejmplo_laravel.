FROM php:8.2-apache

# Instalación de las dependencias del sistema y entorno.
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libsqlite3-dev \
    nodejs \
    npm

# Limpiar caché de intalaciones (reduce el peso de la imagen)
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalación de las extensiones de PHP
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Activa Apache mod_rewrite para manejo de url.
RUN a2enmod rewrite

# Configurar los documentos apache apuntando a una carpeta pública y evita que las variables de entorno se queden expuestos.
    # el comando sed se encarga de buscar y reemplazar el texto /var/www/html por la variable APACHE_DOCUMENT_ROOT a la ruta del proyecto.
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Obtiene la última versión de composer para gestionar las dependencias de Laravel (composer es un gestor de php).
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo.
WORKDIR /var/www/html

# Copia el directorio de la aplicación.
COPY . /var/www/html

# Instala las dependencias de composer (descomentar si se desea instalarlas durante la compilación)
# RUN composer install --no-interaction --optimize-autoloader --no-dev

# Le otorga permisos al usuario www-data para acceder a las carpetas storage y bootstrap/cache.
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Expone el puerto 80 para que Apache pueda recibir peticiones.
EXPOSE 80
