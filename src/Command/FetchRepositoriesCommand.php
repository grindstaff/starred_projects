<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\ExternalRequest;
use App\Service\UpdateRepositories;

class FetchRepositoriesCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'repositories:fetch';
    private $externalRequestService;
    private $updateRepositoryService;
    private $projectUrlParameters = '?q=:php&sort=stars&order=desc&per_page=100';

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

        $url = $this->getContainer()->getParameter('project_api_url') . $this->projectUrlParameters;

        $repositories = json_decode($this->externalRequestService->performRequest($url), true);
        $this->updateRepositoryService->performRequest($repositories['items']);

        $output->writeln([
            'Operation Successful!',
        ]);
    }
}