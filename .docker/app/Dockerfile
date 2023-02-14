FROM ubuntu:20.04

LABEL maintainer="Steve Pabatao"
ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin vim iputils-ping \
    && mkdir -p ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys E5267A6C \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys C300EE8C \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu focal main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y php7.3-fpm php7.3-cli php7.3-dev \
       php7.3-pgsql php7.3-sqlite3 php7.3-gd \
       php7.3-curl php7.3-memcached \
       php7.3-imap php7.3-mysql php7.3-mbstring \
       php7.3-xml php7.3-zip php7.3-bcmath php7.3-soap \
       php7.3-intl php7.3-readline \
       php7.3-msgpack php7.3-igbinary php7.3-ldap \
       php7.3-redis \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sL https://deb.nodesource.com/setup_15.x | bash - \
    && apt-get install -y nodejs \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ENV APP_SERVICE=wa-app

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php7.3

RUN groupadd --force -g 1000 www
RUN useradd -ms /bin/bash --no-user-group -g 1000 -u 1000 www
RUN sed -ie "s/.*listen = .*/listen = ${APP_SERVICE}:9000/" /etc/php/7.3/fpm/pool.d/www.conf
RUN sed -ie "s/.*upload_max_filesize.*/upload_max_filesize = 8M/" /etc/php/7.3/fpm/php.ini

# Create php log dir
RUN mkdir -p /var/log/php-fpm

# Create workdir
RUN mkdir -p /srv/html

# Set directory ownership
RUN chown www:www /srv/html -R

WORKDIR /srv/html

COPY start-container /usr/local/bin/start-container
COPY supervisor/default.conf /etc/supervisor/conf.d/default.conf
RUN chmod +x /usr/local/bin/start-container

EXPOSE 9000 9001

ENTRYPOINT ["start-container"]