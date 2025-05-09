FROM php:8.2-fpm-buster
RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    git \
    curl \
    rsync \
    gnupg \
    unzip \
    mariadb-client \
    openssh-client \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libcurl4-openssl-dev \
    libldap2-dev \
    libicu-dev \
    libc-client-dev \
    libkrb5-dev \
    libtidy* \
    libzip-dev \
    libxml2-dev \
    freetds-dev \
    freetds-bin \
    freetds-common \
    libdbd-freetds;

RUN docker-php-ext-install \
    curl \
    pdo_mysql \
    exif \
    tidy \
    zip \
    bcmath \
    opcache \
    soap \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd \
    && docker-php-ext-configure ldap --with-libdir=lib/$(uname -m)-linux-gnu \
    && docker-php-ext-install ldap \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && openssl;

RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl

RUN docker-php-ext-install calendar
RUN docker-php-ext-install iconv
RUN docker-php-ext-install soap

RUN echo "memory_limit=-1" > $PHP_INI_DIR/conf.d/memory-limit.ini \
    && echo "date.timezone=Europe/Warsaw" > $PHP_INI_DIR/conf.d/date_timezone.ini

RUN docker-php-ext-configure pdo_dblib --with-libdir=lib/$(uname -m)-linux-gnu && \
    docker-php-ext-install pdo_dblib

RUN apt-get install unixodbc unixodbc-dev -y \
    && docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr \
    && docker-php-ext-install pdo_odbc

RUN apt-get update -yqq \
    && apt-get install -y --no-install-recommends openssl \
    && sed -i -E 's/(CipherString\s*=\s*DEFAULT@SECLEVEL=)2/\11/' /etc/ssl/openssl.cnf \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

# # Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer selfupdate

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_HOME=/root/composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /tmp

RUN usermod -u 1000 www-data
RUN usermod -a -G www-data root
RUN chown -R www-data:www-data /var/www

WORKDIR /var/www

EXPOSE 9000

CMD ["php-fpm"]
