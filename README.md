# Project - short url app

Create and document a small web service exposing URL shortening functions.
One should be able to create, read, and delete shortened URLs.
The API functions will be exposed under the '/api' path while accessing a shortened URL at the
root level will cause redirection to the shortened URL.

### Prerequisites

```
docker: 3
```

### Installing

1. Set docker containers
```
docker-compose up
```
2. Install composer packages
```
docker exec -ti php-container composer install
```
3. Run database migrations
```
docker exec -ti php-container php bin/console doctrine:migrations:migrate
```
4. Start message worker
```
docker exec -ti php-container php bin/console messenger:consume -vv
```

## Description
App is built with the use of Symfony framework, API Platform bundle, Doctrine, Redis and RabbitMQ messenger. 

API Platform bundle comes with a handy swagger support. Swagger docs can be found on endpoint ```^api/docs```

Application url is: ```localhost:8080```  

API endpoint


## Testing
Functional tests covers most of the API requests. Before running tests you need to (one time): 
1. Create test db
```
docker exec -ti php-container php bin/console doctrine:database:create --env=test
```
2. Create test schema 
```
docker exec -ti php-container php bin/console doctrine:schema:create --env=test
```

Before running tests, start test worker to consume messages:
```
docker exec -ti php-container php bin/console messenger:consume -vv  --env=test
```
Tests can be started with command:
```
docker exec -ti php-container php bin/phpunit
```


## Built With

* [Symfony](https://symfony.com/) - The web framework used
* [API Platform](https://api-platform.com/) - The API Platform Framework
* [Docker](https://www.docker.com/) - OS-level virtualization to deliver software in containers
* [Swagger](https://swagger.io/) - Swagger is an Interface Description Language for describing RESTful APIs expressed using JSON.
* [Redis](https://redis.io/) - Redis is an open source (BSD licensed), in-memory data structure store.
* [RabbitMQ](https://www.rabbitmq.com/) - RabbitMQ - message broker 
