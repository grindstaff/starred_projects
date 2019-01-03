<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Project;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()
        ->getRepository(Project::class)
        ->findAll();

    	return $this->render('Home/index.html.twig', array('projects' => $projects));
    }
}
