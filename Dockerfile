FROM ubuntu:latest

RUN apt-get update && apt-get install software-properties-common -y
RUN add-apt-repository -y ppa:ondrej/php && apt-get update
RUN apt-get install nginx php7.2 php7.2-fpm php7.2-common php7.2-mysql php7.0-mbstring php7.2-cli -y
RUN apt-get install -y nodejs
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN apt-get install nodejs-npm
RUN npm install -g yarn


COPY . /var/www/html/
COPY Docker/nginx /etc/ningx


EXPOSE 80 3306 25