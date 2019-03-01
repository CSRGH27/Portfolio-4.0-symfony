<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;
use App\Entity\Project;
use App\Entity\Language;


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

    /**
     *  @Route("portfolio/project/{id}", name="project_show", options={"expose"=true})
     */
    public function show(Project $project){
        return $this->render('portfolio/show.html.twig', [
            'project' => $project,
            
        ]);
    }
}
