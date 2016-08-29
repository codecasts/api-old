#!/bin/bash

# Copy over testing configuration.
cp .env.testing .env

# Generate an application key.
php artisan key:generate

# Run PHPUnit Tests
php vendor/bin/phpunit --colors=never --coverage-text
