FROM nginx:alpine

MAINTAINER Gieandes Silva contato@gieandessilva.com

RUN apk --update add supervisor

RUN rm /var/cache/apk/*

COPY ./vhost.conf /etc/nginx/nginx.conf
COPY ./supervisord-web.conf /etc/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
