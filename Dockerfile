FROM php:8.4-fpm

# Install system dependencies, PHP extensions, and add Node.js repository
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nginx \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y確 nodejs \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy code
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 🚀 NEW: Install Node dependencies and compile production assets with Vite
RUN npm install && npm run build

# Setup Nginx configuration to point to Laravel's public/ folder
RUN echo "server { \n\
    listen 80; \n\
    root /var/www/public; \n\
    index index.php index.html; \n\
    location / { \n\
        try_files \$uri \$uri/ /index.php?\$query_string; \n\
    } \n\
    location ~ \.php$ { \n\
        include fastcgi_params; \n\
        fastcgi_pass 127.0.0.1:9000; \n\
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name; \n\
    } \n}" > /etc/nginx/sites-available/default

# Ensure the storage and bootstrap/cache directories exist and have proper permissions
RUN mkdir -p /var/www/storage/framework/views \
             /var/www/storage/framework/cache \
             /var/www/storage/framework/sessions \
             /var/www/bootstrap/cache

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port 80 for Nginx
EXPOSE 80

# Run migrations, start PHP-FPM, and run Nginx
CMD php artisan migrate --force && php-fpm -D && nginx -g "daemon off;"