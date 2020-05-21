<?php
/**
 * Lists class
 *
 * @package  ShahariaAzam\NewsAggregator\Cli\Commands\NewsSource
 */


namespace Shaharia\NewsAggregator\Commands;


use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;
use Shaharia\NewsAggregator\SourceMaps;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class NewsSourceLists extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'news:sources';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Command about news sources')
            ->setDefinition(
                new InputDefinition([
                    new InputOption('list', 'l', InputOption::VALUE_NONE),
                    new InputOption('show', 's', InputOption::VALUE_REQUIRED)
                ])
            );;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('list')) {
            $this->listSourcesAsTable($output);
            return 0;
        }

        if ($input->getOption('show')) {
            $this->sourceDetails($input, $output);
        }

        return 0;
    }

    private function listSourcesAsTable(OutputInterface $output)
    {
        $sourceMaps = new SourceMaps();

        $tableHeaders = ['Source Slug', 'Name', 'Homepage URL', 'Available Type'];
        $tableRows = [];

        foreach ($sourceMaps->getLists() as $source) {
            /**
             * @var $provider NewsProviderInterface
             */
            $provider = new $source['provider_class'];

            $tableRows[] = [
                $source['provider_slug'],
                $provider->getName(),
                $provider->getHomepageUrl(),
                implode(", ", $sourceMaps->getNewsTypesBySlug($source['provider_slug']))
            ];
        }


        $tableOutput = new Table($output);
        $tableOutput->setHeaders($tableHeaders)
            ->setRows($tableRows);
        $tableOutput->render();
    }

    private function sourceDetails(InputInterface $input, OutputInterface $output)
    {
        $providerSlug = $input->getOption('show');

        $sourceMaps = new SourceMaps();
        $provider = $sourceMaps->getProviderBySlug($providerSlug);
        if (empty($provider)) {
            $output->writeln("Provider doesn't exists");
        }

        $output->writeln("<info>" . "Name\t\t: " . "</info>" . $provider->getName());
        $output->writeln("<info>" . "Homepage\t: " . "</info>" . $provider->getHomepageUrl());
        $output->writeln("<info>" . "Source URL\t: " . "</info>" . $provider->getUrl());
        $output->writeln("<info>" . "Description\t: " . "</info>" . $provider->getDescription());
        $output->writeln("<info>" . "News Format\t: " . "</info>" . implode(", ",
                $sourceMaps->getNewsTypesBySlug($providerSlug)));
    }
}