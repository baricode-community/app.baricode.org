FROM mcr.microsoft.com/devcontainers/php:1-8.4-bookworm

# Hapus repo yarn yang GPG key-nya expired (sudah include di base image)
RUN rm -f /etc/apt/sources.list.d/yarn.list

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    libmemcached-dev \
    zip \
    unzip \
    default-mysql-client \
    redis-tools \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    intl \
    opcache

# Install Redis PHP extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Node.js 22 (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (already included in base image, but ensure it's latest)
RUN composer self-update

# Set working directory
WORKDIR /workspace
