FROM ubuntu:latest

RUN apt-get update && apt-get install software-properties-common curl -y
RUN add-apt-repository -y ppa:ondrej/php && apt-get update
RUN apt-get install nginx php7.2 php7.2-fpm php7.2-common php7.2-mysql php7.2-mbstring php7.2-xml php7.2-zip supervisor nodejs -y && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version
RUN apt-get install npm -y
RUN npm install -g yarn

COPY . /var/www/html/
COPY Docker/nginx /etc/ningx

WORKDIR /var/www/html

COPY composer.json ./
COPY composer.lock ./
RUN composer install --no-scripts --no-autoloader

COPY package.json yarn.lock ./
RUN yarn install --prod

EXPOSE 80