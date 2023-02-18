# docker/php-fpm/Dockerfile

FROM node:14
RUN apt -y update && apt -y upgrade && apt -y install bash
WORKDIR /home/node/app
CMD yarn install; yarn encore dev --watch
