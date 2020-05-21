# Minimal base image for PHP7.2
FROM php:7.4-cli-alpine

# Copy source codes
COPY . /usr/src/news-aggregator-cli

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /usr/src/news-aggregator-cli

# Install composer dependencies
RUN composer install --no-dev

# Set execution permission to ./bin/news
RUN chmod a+x ./bin/news