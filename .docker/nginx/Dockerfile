FROM debian:stretch
RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install -ym nginx

COPY conf/nginx.conf /etc/nginx/nginx.conf
ADD conf/app.conf /etc/nginx/sites-enabled/app.conf
RUN rm /etc/nginx/sites-enabled/default

WORKDIR /opt/app-root

EXPOSE 80
EXPOSE 443

CMD ["nginx"]
