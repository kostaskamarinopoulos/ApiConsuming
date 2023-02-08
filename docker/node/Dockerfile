FROM node:14.17.3-alpine
WORKDIR /var/www/symfony_docker
COPY ["package*.json","./"]
RUN npm install --quiet
COPY . .