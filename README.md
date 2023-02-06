Set up:
- copy .env.example .env
- docker-compose up -d

http://localhost:8080/
http://localhost:8080/email

Tests:
php bin/phpunit
php bin/phpunit tests/unit/..