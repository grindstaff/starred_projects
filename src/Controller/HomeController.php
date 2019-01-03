<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\QueryBuilder;

use App\Entity\Project;

class HomeController extends Controller
{
    protected $requestStack;
    protected $defaultSortParam = 'stars';
    protected $defaultSortDirection = 'DESC';

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $request = $this->requestStack->getCurrentRequest();
        $sortParam = $request->query->get('sortParam') ? $request->query->get('sortParam') : $this->defaultSortParam;

        // Check for allowed parameters in sorting and override to default if illegal parameter is provided - JG 1/3/2019
        
        switch($sortParam){
            case 'id':
            case 'stars':
            case 'name':
            case 'repository_creation_date':
            case 'repository_last_push_date':

            break;

            default:
                $sortParam = $this->defaultSortParam;
        }

        $sortDirection = $request->query->get('sortDirection') ? $request->query->get('sortDirection') : $this->defaultSortDirection;

        switch($sortDirection){
            case 'ASC':
            case 'DESC':

            break;

            default:
                $sortDirection = $this->defaultSortDirection;
        }
        
        $projects = $this->getDoctrine()
                         ->getRepository(Project::class)
                         ->createQueryBuilder('p')
                         ->orderBy("p." . $sortParam, $sortDirection)
                         ->getQuery()
                         ->getResult();                         

    	return $this->render('Home/index.html.twig', array('projects' => $projects, 'sortParam' => $sortParam, 'sortDirection' => $sortDirection));
    }
}
