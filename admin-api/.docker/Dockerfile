# php official fpm image
FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# installs basic tools, then postgres ppa and postgresql-client packages 
# (and some other required dependencies). It then installs and configures several php extensions 
# including pdo_pgsql. Finally, it downloads and installs composer in the image.
RUN apt-get update \
    && apt-get install -y gnupg curl wget ca-certificates unzip lsb-release \
    && wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - \
    && echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs`-pgdg main" | tee  /etc/apt/sources.list.d/pgdg.list \
    && apt-get install -y \
        nano \
        vim \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        postgresql-client \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install intl pdo pdo_pgsql pgsql pdo_mysql mysqli zip bcmath pcntl exif \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install gd
RUN apt-get update \
    && apt-get install -y libpng-dev libjpeg-dev libjpeg62-turbo-dev libfreetype6-dev libwebp-dev \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && apt-get remove -y libpng-dev libjpeg-dev libjpeg62-turbo-dev libfreetype6-dev libwebp-dev \
    && rm -rf /var/lib/apt/lists/*

# Install imagick
RUN apt-get update \
    && apt-get install -y libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apt-get remove -y libmagickwand-dev \
    && rm -rf /var/lib/apt/lists/*

# curl extension
RUN apt-get update \
    && apt-get install -y libcurl4-openssl-dev \
    && docker-php-ext-install curl \
    && apt-get remove -y libcurl4-openssl-dev \
    && rm -rf /var/lib/apt/lists/*

# Set allow_url_fopen true
RUN sed -i "s/;allow_url_fopen = On/allow_url_fopen = On/" /usr/local/etc/php/php.ini-production
RUN sed -i "s/;allow_url_fopen = On/allow_url_fopen = On/" /usr/local/etc/php/php.ini-development

# Set memory_limit
ENV PHP_MEMORY_LIMIT=1024M

# Create system user
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
# COPY . /var/www/html

# Set working directory
WORKDIR /var/www

USER $user