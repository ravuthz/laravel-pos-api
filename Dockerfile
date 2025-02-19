FROM php:8.3-fpm-alpine3.21

RUN apk add --update --no-cache git zip wget curl bash sudo shadow supervisor dcron nodejs npm nginx openssh && rm -rf /var/cache/apk/*

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd zip intl pcntl bcmath sockets opcache pdo_mysql pdo_pgsql

COPY --from=composer:2.8.4 /usr/bin/composer /usr/bin/composer

RUN mkdir -p /var/run && chmod 777 /var/run

RUN mkdir -p /var/log/supervisor /etc/supervisor/conf.d

RUN chown -R www-data:www-data /var/www/html

RUN ssh-keygen -A && \
    echo 'PermitRootLogin yes' >> /etc/ssh/sshd_config && \
    echo 'PasswordAuthentication yes' >> /etc/ssh/sshd_config && \
    echo 'root:root' | chpasswd

WORKDIR /var/www/html

RUN git config --global --add safe.directory /var/www/html

COPY . .
COPY .docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY .docker/nginx/default.conf /etc/nginx/conf.d/default.conf

COPY .docker/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

RUN ls -lah /usr/local/etc/php/

COPY .docker/php/php.ini /usr/local/etc/php/php.ini
COPY .docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

COPY .docker/php/info.php /var/www/html/public/info.php

COPY .docker/start.sh /var/www/html/start.sh
RUN chmod +x /var/www/html/start.sh && /var/www/html/start.sh

EXPOSE 22 80 8080 9000 9001

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisor.conf"]

HEALTHCHECK CMD curl --fail http://localhost:9000 || exit 1
