# PHP South Wales Speaker Leaderboard

A Symfony Console application that shows a list of all of the speakers we've had for PHP South Wales, and how many talks each has done. The data is retrieved from the website's Drupal-powered JSON API.

## Usage

Building the Docker containers:

    docker-compose build

Running tests:

    docker-compose run --rm composer test

Generating the leaderboard:

    docker-compose run --rm app php-south-wales:generate-leaderboard
