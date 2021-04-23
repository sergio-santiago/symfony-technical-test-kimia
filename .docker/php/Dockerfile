FROM ubuntu:18.04
ARG XDEBUG_KEY

RUN export DEBIAN_FRONTEND=noninteractive
RUN apt-get upgrade -y && apt-get update -y
RUN apt-get -ym install software-properties-common
RUN add-apt-repository ppa:ondrej/php

RUN apt-get install -y tzdata
RUN ln -snf /usr/share/zoneinfo/Europe/Madrid /etc/localtime
RUN dpkg-reconfigure --frontend noninteractive tzdata

RUN apt-get install -ym curl && \
    apt-get install -ym wget && \
    apt-get install -ym tree && \
    apt-get install -ym zlib1g-dev && \
    apt-get install -ym vim && \
    apt-get install -ym telnet && \
    apt-get install -ym php7.2 && \
    apt-get install -ym php7.2-mbstring && \
    apt-get install -ym php7.2-xml && \
    apt-get install -ym php-pear && \
    apt-get install -ym php7.2-dev && \
    apt-get install -ym php7.2-fpm && \
    apt-get install -ym php7.2-zip && \
    apt-get install -ym php7.2-soap && \
    apt-get install -ym php7.2-mysql && \
    apt-get install -ym php7.2-xdebug && \
    apt-get install -ym php7.2-curl && \
    apt-get install -ym dnsutils && \
    apt-get install -ym iproute2

RUN mkdir /run/php

ADD bin/xdebug.sh /bin/xdebug.sh
RUN chmod +x /bin/xdebug.sh
RUN /bin/xdebug.sh

ADD conf/www.conf /etc/php/7.2/fpm/pool.d/www.conf
ADD conf/php-fpm.conf /etc/php/7.2/fpm/php-fpm.conf

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

WORKDIR /opt/app-root

RUN mkdir -p -m 777 /var/kimia-finance-managing-files

EXPOSE 9000

CMD ["php-fpm7.2","-F"]
