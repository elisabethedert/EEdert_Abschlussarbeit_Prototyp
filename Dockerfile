# Source: https://github.com/Boadzie/blogy-laravel/blob/main/Dockerfile

ARG PHP_VERSION=8.3
ARG NODE_VERSION=20
FROM fideloper/fly-laravel:${PHP_VERSION} as base

# copy our code
COPY . /var/www/html

# install all php packages
RUN composer install --optimize-autoloader --no-dev \
    && mkdir -p storage/logs \
    && chown -R www-data:www-data /var/www/html 

# build vite into static html/css/js
FROM node:${NODE_VERSION} as node_modules_go_brrr
RUN mkdir /app
RUN mkdir -p  /app
WORKDIR /app
COPY . .
COPY --from=base /var/www/html/vendor /app/vendor
RUN npm ci --no-audit && npm run build


FROM base
# copy static html/css/js from node_modules_go_brrr
COPY --from=node_modules_go_brrr /app/public /var/www/html/public-npm
RUN rsync -ar /var/www/html/public-npm/ /var/www/html/public/ \
    && rm -rf /var/www/html/public-npm \
    && chown -R www-data:www-data /var/www/html/public

EXPOSE 8080
