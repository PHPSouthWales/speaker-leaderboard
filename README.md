# PHP South Wales Speaker Leaderboard

A Symfony Console application that shows a list of all of the speakers we've had for PHP South Wales, and how many talks each has done. The data is retrieved from the website's Drupal-powered JSON API.

## Usage

Building the Docker container:

    docker build . -t leaderboard:latest

Running tests:

    docker run -it -u $UID:$GID leaderboard phpunit

Generating the leaderboard:

    docker run -it -u $UID:$GID leaderboard console php-south-wales:generate-leaderboard

Working with a local volume:

    docker run -it -u $UID:$GID -v $(pwd):/app leaderboard console php-south-wales:generate-leaderboard
