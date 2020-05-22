# News Aggregator in PHP

![CI](https://github.com/shahariaazam/news-aggregator/workflows/CI/badge.svg)
![Code Coverage](https://scrutinizer-ci.com/g/shahariaazam/news-aggregator/badges/coverage.png)
![Code Quality](https://scrutinizer-ci.com/g/shahariaazam/news-aggregator/badges/quality-score.png)

An universal **News Aggregator** for PHP developers. Easy, flexible and extendable library to get news headlines and full news article
programmatically.

## Table of Contents
- [Installation](#installation)
    - [With Composer](#with-composer)
- [Usage](#usage)
    - [From Application](#from-application)
    - [Command Line](#command-line)
    - [Advanced Usage](#advance-usage)
    - [Docker](#docker-image)
- [How to extend](#how-to-extend-it)
- [CLI Commands](#cli-commands)
- [Available News Sources](#available-news-sources)
    - [BBC](#bbc)
    - [Daily Prothom Alo](#the-daily-prothom-alo)
- [Issue & Bug Reports](#issue--bug-reporting)
- [Contributing](#contributing)
    - [List of contributors](#list-of-contributors)
 
## Installation

### With Composer
To use this library in your application, you can install this using `composer`. Just run the following command.

```sh
composer require shahariaazam/news-aggregator
```

That's it.

## Usage

### From Application

You can easily get news from supported news provider from your application. Here is a simple code snippet that can return headlines
from a specific news provider;

```php
<?php

use Shaharia\NewsAggregator\NewsProvider\BBC\BBC;
use Shaharia\NewsAggregator\NewsProvider\BBC\HomepageParser;
use Shaharia\NewsAggregator\Entity\Headline;

require __DIR__ . "/vendor/autoload.php";

$aggregator = Shaharia\NewsAggregator\Aggregator::init();

/**
 * To get headlines we need to setup news provider and it's appropriate parser class
 * that will parse that provider's headlines.
 *
 * In this example, we are going to fetch all the headlines from BBC's homepage
 */
$headlines = $aggregator->getHeadlines(
    BBC::class,   // BBC News provider class
    HomepageParser::class  // BBC Homepage news parser class
);

var_dump($headlines);   // it will return Headline[] entity object
```

You can find all supported news provider and it's associated parser class from [here](#available-news-sources)

### Command Line

You can also get news from specific source from your command line. Here is a simple command to read all the headlines
from BBC homepage.

```bash
./bin/news headlines --list bbc-home
```
_note: `bbc-home` is the provider's slug. You can find all supported news provider and it's associated 
provider class from [here](#available-news-sources)_

List of all supported commands, arguments and options are available [here](#cli-commands)

## How to extend it?
```php
/**
*   Customize your aggregator engine with your own libraries.
*   This library complies with dependency inversion principle.
*   
*   Attach your own PSR-7 compatible HTTP client
*   Attach your request factory, stream factory
*   Enable Cache with PSR-6 compatible caching library
*   Logger with PSR-3 compatible Logging client.
*/
$aggregator = Shaharia\NewsAggregator\Aggregator::init();
$aggregator->setHttpClient($client);
$aggregator->setRequestFactory($requestFactory);
$aggregator->setStreamFactory($streamFactory);
$aggregator->setCache($cache);
$aggregator->setLogger($logger);
```

## Docker Image
You can also fetch news from your favorite source or read news from Docker container. To run your Docker container, write the following command -

```bash
docker run -it --rm shaharia/news-aggregator news headlines --list {NEWS_PROVIDER_SOURCE_SLUG} --json --with-url
```

### CLI Commands

Here is the list of command line arguments

- ./bin/news headlines --help

```bash
Usage:
  headlines [options]

Options:
  -s, --source=SOURCE   Source of the news
  -u, --with-url        With news URL
  -j, --json            Output in JSON format
```

- ./bin/news sources --help

```bash
Usage:
  sources [options]

Options:
  -l, --list            List of available news sources
  -s, --show=SHOW       Show details about specific news source
```

## Available News Sources

#### BBC

**Homepage**
- Provider slug: `bbc-home`
- URL: [https://www.bbc.com/news](https://www.bbc.com/news)
- Provider class: `Shaharia\NewsAggregator\NewsProvider\BBC\BBC`
- Parser class: `Shaharia\NewsAggregator\NewsProvider\BBC\HomepageParser`
- Supported Format: `Headlines`

#### The Daily Prothom Alo

**Homepage**
- URL: [https://www.prothomalo.com/](https://www.prothomalo.com/)
- Provider class: `Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ProthomAlo`
- Parser class: `Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserList`
- Supported Format: `Headlines`

## Issue & bug reporting

Please create a new issue from [here](https://github.com/shahariaazam/news-aggregator/issues)

## Contributing
There are so many news providers available globally. It's not possible for me to create parser for all
of them. But no worry, you are very much welcome to contribute.

You can contribute by -
- Adding new News Provider (w/o parser)
- Add new parser
- Participate in the GitHub community in Issue, discussion, etc.
- Create new issue, bug report
- Fix existing issues/bugs
- Help others

### List of Contributors

- [Shaharia Azam](https://github.com/shahariaazam)

You can see full lists of contributors from [here](#)
