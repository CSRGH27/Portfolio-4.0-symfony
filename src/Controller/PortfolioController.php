<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;

class PortfolioController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('portfolio/home.html.twig',[
            'controller_name' => 'PortfolioController',
        ]);
    }

    /**
     *  @Route("portfolio/project", name="project")
     */
    public function project(ProjectRepository $repo)
    {
        $project = $repo->findAll();

        return $this->render('portfolio/project.html.twig', [
            'controller_name' => 'PortfolioController',
            'projects' => $project,
        ]);
        
    }
}
