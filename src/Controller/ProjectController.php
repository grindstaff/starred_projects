<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Project;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class ProjectController extends Controller
{
    /**
     * @Route("/project/{id}", name="view_project")
     */
    public function viewProjectAction($id)
    {
      $project = $this->getDoctrine()
      ->getRepository(Project::class)
      ->findOneBy(array('id' => $id));

    	return $this->render('Project/project.html.twig', array('project' => $project));
    }

    /**
     * @Route("/projects/update", name="update_projects")
     */
    public function updateProjectsAction(KernelInterface $kernel)
    {
      $application = new Application($kernel);
      $application->setAutoExit(false);

      $input = new ArrayInput(array(
         'command' => 'repositories:fetch'
      ));

      // You can use NullOutput() if you don't need the output
      $output = new BufferedOutput();
      $application->run($input, $output);

      $this->addFlash(
        'notice',
        'List Updated!'
      );

      return $this->redirectToRoute('home');
    }
}
