## Setup

- git clone git@github.com:kostaskamarinopoulos/ApiConsuming.git
- cd ApiConsuming
- copy .env.example .env
- Add the correct values in the .env (sent throught the email)
- composer install
- docker-compose up -d

### Run locally

- Form: http://localhost:8080/
- Table: eg. http://localhost:8080/historical/1675434605/1675434599?symbol=AAOI

## Run functional tests

- php bin/phpunit tests/unit