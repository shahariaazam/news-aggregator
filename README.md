# Simple News Aggregator in PHP

![CI](https://github.com/shahariaazam/news-aggregator/workflows/CI/badge.svg)
![Code Coverage](https://scrutinizer-ci.com/g/shahariaazam/news-aggregator/badges/coverage.png)
![Code Quality](https://scrutinizer-ci.com/g/shahariaazam/news-aggregator/badges/quality-score.png)

An universal **News Aggregator** for PHP developers. Easy, flexible and extendable library to get news headlines and full news article
programmatically.

There has been 2 (two) types of interfaces here. So you can easily extend and add more news providers easily.
    
    - Shaharia\NewsAggregator\Interfaces\NewsProvidersInterface
    You can add any new news provider or their homepage or category pages.
    
    - Shaharia\NewsAggregator\Interfaces\ParserInterface
    Define the parsing capabilities by creating another Parser

That's it. I have tried to keep it very very simple but extensible. 
 
 
### Installation

You can install this library using `composer`. Just run the following command.

```sh
composer require shahariaazam/news-aggregator
```
That's it.

### Usage

#### Simple Usage
For more basic and easiest code example.

```php
<?php
require __DIR__ . "/vendor/autoload.php";

$aggregator = Shaharia\NewsAggregator\Aggregator::init();

/**
 * Get a list of headlines
 * @var $headlines \Shaharia\NewsAggregator\Entity\Headline[]
 */
$headlines = $aggregator->getHeadlines(
    \Shaharia\NewsAggregator\NewsProvider\ProthomAlo\NorthAmericaCategory::class,   // News provider class
    \Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserList::class  // Parser class
);

var_dump($headlines);


/**
 * Get details of a news article
 *
 * @var $news \Shaharia\NewsAggregator\Entity\News
 */
$news = $aggregator->getNews(
    $headlines[0]->getUrl(),    // Specific news URL
    \Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserSingle::class    // Parser class to parse new. For every news provider, parser class is different
);

var_dump($news);
```
#### Advance Usage
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

### Issue & bug reporting
Please create a new issue from https://github.com/shahariaazam/news-aggregator/issues

### Contribution
There are so many news providers available globally. It's not possible for me to create parser for all
of them. But no worry, you are very much welcome to contribute.

You can contribute by -
- Adding new News Provider (w/o parser)
- Add new parser
- Participate in the GitHub community in Issue, discussion, etc.
- Create new issue, bug report
- Fix existing issues/bugs
- Help others

### Contributors
- [Shaharia Azam](https://github.com/shahariaazam) and other [contributors](https://github.com/shahariaazam/news-aggregator/graphs/contributors).
