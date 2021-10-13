FROM wyveo/nginx-php-fpm:php72

WORKDIR /usr/share/nginx/
RUN rm -rf /usr/share/ngix/html
COPY . /usr/share/nginx
RUN chmod -R 775 /usr/share/nginx/storage/*
RUN ln -s public html

RUN apt update \
        && apt install -y \
            g++ \
            libicu-dev \
            libpq-dev \
            libzip-dev \
            zip \
            zlib1g-dev 

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install