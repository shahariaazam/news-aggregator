<?php
/**
 * NewsHeadline class
 *
 * @package  ShahariaAzam\NewsAggregator\Cli\Commands
 */


namespace Shaharia\NewsAggregator\Commands;

use Shaharia\NewsAggregator\Aggregator;
use Shaharia\NewsAggregator\SourceMaps;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NewsHeadline extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'headlines';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Show headlines of news')
            ->setDefinition(
                new InputDefinition([
                    new InputOption('source', 's', InputOption::VALUE_REQUIRED, 'Source of the news'),
                    new InputOption('with-url', 'u', InputOption::VALUE_NONE, 'With news URL'),
                    new InputOption('json', 'j', InputOption::VALUE_NONE, 'Output in JSON format')
                ])
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('source')) {
            $providerSlug = $input->getOption('source');

            $sourceMaps = new SourceMaps();
            $provider = $sourceMaps->getHeadLineProviderBySlug($providerSlug);

            if (empty($provider)) {
                $output->writeln("Invalid news source");
                return 1;
            }

            $aggregator = Aggregator::init();
            $headlines = $aggregator->getHeadlines(
                $provider['provider_class'],   // News provider class
                $provider['provider_parser']  // Parser class
            );

            if ($input->getOption('json')) {
                $data = [];
                foreach ($headlines as $headline) {
                    if ($input->getOption('with-url')) {
                        $data[] = ['headline' => $headline->getTitle(), 'url' => (string) $headline->getUrl()];
                    } else {
                        $data[] = ['headline' => $headline->getTitle()];
                    }
                }

                $output->writeln(json_encode($data, JSON_PRETTY_PRINT));
            } else {
                foreach ($headlines as $headline) {
                    if ($input->getOption('with-url')) {
                        $output->writeln($headline->getTitle());
                        $output->writeln("Link: " . $headline->getUrl());
                    } else {
                        $output->writeln($headline->getTitle());
                    }

                    $output->writeln("--------------");
                }
            }
        }

        return 0;
    }
}
