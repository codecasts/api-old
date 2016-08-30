# CODECASTS - API

API GIT Repository.
This document should be the ultimate guide on running and specs about the api source code.

## Build status

| Branch        | Environment      | URL                                                                                 | Status                                                                                                                                     | Test Coverage                                                                                                                        |                     
|---------------|------------------|-------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------|------------------------------------------------|
| **`master`**  | **`production`** | [https://api.codecasts.rocks](https://api.codecasts.rocks)                          | [![Build Status](https://travis-ci.org/codecasts/api.svg?branch=master)](https://travis-ci.org/codecasts/api)                              | [![codecov](https://codecov.io/gh/codecasts/api/branch/master/graph/badge.svg)](https://codecov.io/gh/codecasts/api)                 |
| **`develop`** | **`staging`**    | [https://api.sandbox.codecasts.rocks](https://api.sandbox.codecasts.rocks)          | [![Build Status](https://travis-ci.org/codecasts/api.svg?branch=develop)](https://travis-ci.org/codecasts/api)                             | [![codecov](https://codecov.io/gh/codecasts/api/branch/develop/graph/badge.svg)](https://codecov.io/gh/codecasts/api)                |

## Index

* [Build status](#build-status)
  * [Development](#development)
    * [Requirements](#requirements)
    * [Operating the docker environment](#operating-the-docker-environment)
      * [Starting services](#starting-services)
      * [Stoping services](#stoping-services)
      * [Running internal commands](#running-internal-commands)
      * [List of Services](#list-of-services)
  * [Coding Guide Lines](#coding-guide-lines)
    * [Style](#style)
    * [Unit Testing](#unit-testing)

## Development
For using the docker version (recommended) of the environment, you first need to stop local
services like MySQL, Redis, Elasticsearch and web servers running on port 80.

### Requirements

- **Docker** >= 1.10.3.
- **docker-compose**, if not already bundled in your docker install.
- A virtual host named **codecasts.app** pointing to 127.0.0.1, this step is needed since the social login callbacks are using this URL.

### Operating the docker environment

#### Starting services

- Option 1: Keeping the output visible on the terminal
```php
docker-compose up
```

- Option 2 : Sending the output of the services to background
```php
docker-compose up -d
```

#### Stopping services

- Option 1: When the output is visible (started with option 1), just hit **`control + c`** to stop it.

- Option 2: When the services are on background or failed to stop with **`control + c`**, you can stop them with the following command:
```php
docker-compose down
```

#### Running internal commands

When commands like artisan are needed, those commands would need to run inside the docker containers, to do so, use the following sintax:

```php
docker-compose run {service-name} {command-you-want-to-run}
```

For example. to run migrations, you can do:

```php
docker-compose run app php artisan migrate
```

Another example, starting a terminal inside the MySQL service

```php
docker-compose run mysql /bin/bash
```

#### List of Services
The service names can be located inside the **`docker-compose.yml`** file, right now, the following are enabled:

| Service       | Description                                                   |
|---------------|---------------------------------------------------------------|
| **`cache`**   | Runs a Redis 3.2 Instance for Cache and queues                |
| **`mysql`**   | Runs a MySQL 5.7 Instance for Database                        |
| **`api`**     | PHP and Caddy Instance that runs the application              |
| **`queue`**   | A PHP-CLI container, running php artisan queue:listen command |
| **`elastic`** | Elasticsearch instance for search indexing                    |


## Important Notice
This application uses strict URL binding. It means the URL used on APP_DOMAIN env key should be the
one you're accessing the application through.
Also there is a APP_SECURE env key that defines the use of HTTPS or not, both keys should be
respected when using the API in development and setting up login providers
such GitHub

## Coding Guide Lines

### Style
**PSR-1** & **PSR-2** should be enforced, a copy of php-cd-fixer is distributed along with the PHP Docker image, so the following command can automatically format the code before commiting:

```php
docker-compose run api php-cs-fixer --diff --fixers=-psr1,-psr2 fix app
```

As a alternative, you can alias that command as **`psr2`** or other name:

```php
# Bash and ZSH
alias psr2="docker-compose run api php-cs-fixer --diff --fixers=-psr1,-psr2 fix"

# Fish shell
alias psr2 "docker-compose run api php-cs-fixer --diff --fixers=-psr1,-psr2 fix"
```

### Unit Testing
Following the same structure of existing tests, the main rule it keep tests under the same namespace as the class being tested, in order to avoid useless imports and keep code cleaner

Code coverage as HTML is already ignored on git when generated on the `coverage` directory, to run tests with coverage reports, use

```php
php vendor/bin/phpunit --coverage-html=coverage
```

Or to see coverage reports directly on the terminal

```php
php vendor/bin/phpunit --coverate-text
```
