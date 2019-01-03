<?php

namespace App\Service;
use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

class UpdateRepositories
{
  protected $em;

  public function __construct(EntityManagerInterface $em)
  {
      $this->em = $em;
  }
  
  public function performRequest($newRepositories)
  {
    $qb = $this->em->createQueryBuilder();
    $qb->delete(Project::class)->getQuery()->execute();

    forEach($newRepositories as $newRepository)
    {
      $project = new Project();
      $project->setRepositoryId($newRepository['id']);
      $project->setName($newRepository['name']);
      $project->setUrl($newRepository['html_url']);
      $project->setRepositoryCreationDate(new \DateTime($newRepository['created_at']));
      $project->setRepositoryLastPushDate(new \DateTime($newRepository['pushed_at']));
      $project->setDescription($newRepository['description']);
      $project->setStars($newRepository['stargazers_count']);

      $this->em->persist($project);
    }
    
    $this->em->flush();
  }
}