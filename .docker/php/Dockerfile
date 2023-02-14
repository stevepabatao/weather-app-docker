FROM php:7.3-apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create group
RUN groupadd -g 1000 www

# Create user
# set user id
# assign to existing group id "1000"
# set shell "/bin/bash"
RUN useradd -s /bin/bash -u 1000 -g 1000 www

# Create workdir
RUN mkdir -p /srv/html

# Set directory ownership
RUN chown www:www /srv/html -R

# Install supervisor
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    supervisor

COPY ./supervisord.conf /etc/supervisor
COPY ./supervisor/* /etc/supervisor/conf.d

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]