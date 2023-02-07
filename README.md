Set up:
- copy .env.example .env
- docker-compose up -d

http://localhost:8080/
http://localhost:8080/email
eg. http://localhost:8080/historical/1675434605/1675434599?symbol=AAOI

Tests:
php bin/phpunit
php bin/phpunit tests/unit/..