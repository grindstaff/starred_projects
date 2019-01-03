<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\ExternalRequest;
use App\Service\UpdateRepositories;

class FetchRepositoriesCommand extends Command
{
    protected static $defaultName = 'repositories:fetch';
    private $externalRequestService;
    private $updateRepositoryService;

    public function __construct(ExternalRequest $externalRequestService, UpdateRepositories $updateRepositoryService)
    {
        $this->externalRequestService = $externalRequestService;
        $this->updateRepositoryService = $updateRepositoryService;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        $output->writeln([
            'Fetching Repositories'
        ]);
        
        $url = 'https://api.github.com/search/repositories?q=:php&sort=stars&order=desc&per_page=100';

        $repositories = json_decode($this->externalRequestService->performRequest($url), true);
        $this->updateRepositoryService->performRequest($repositories['items']);

        $output->writeln([
            'Operation Successful!',
        ]);
    }
}