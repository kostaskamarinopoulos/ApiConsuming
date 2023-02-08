## Setup

- git clone git@github.com:kostaskamarinopoulos/ApiConsuming.git
- cd ApiConsuming
- cp .env.example .env
- docker-compose up -d --build
- docker exec -it php bash
- Run in the conatiner `composer install && npm i && npm run watch`

### Run locally

- Form: http://localhost:8080/
- Table: eg. http://localhost:8080/historical/1675434605/1675434599?symbol=AAOI

## Run functional tests

- php bin/phpunit tests/unit
