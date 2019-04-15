<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;




class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'user' => $user
        ]);
    }

    /**
     * @Route("/dashboard/list-project", name="list_project")
     */
    public function listProject(ProjectRepository $repo){
            $project = $repo->findAll();
            return $this->render('dashboard/list-project.html.twig', [
                'controller_name' => 'DashboardController',
                'projects' => $project,
            ]);
    }
    /**
     * @Route("/dashboard/new-project", name="create_project")
     */
    public function createProject(Request $request, ObjectManager $manager){
        $project = new Project();
            
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()){
            
           $manager->persist($project);
           $manager->flush();
           return $this->redirectToRoute('list_project');
            
        }   
        return $this->render('dashboard/new-project.html.twig',[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/dashboard/edit-project/{id}", name="edit_project")
     */
    public function editProject(Request $request, ObjectManager $manager, $id){
        $project = new Project();
        $project = $this->getDoctrine()->getRepository
        (Project::class)->find($id);
            
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()){
            
           $manager = $this->getDoctrine()->getManager();
           $manager->persist($project);
           $manager->flush();
           return $this->redirectToRoute('list_project');
            
        }   
        return $this->render('dashboard/edit-project.html.twig',[
            'form' => $form->createView(),
            'project' =>$project,
        ]);
    }

    /**
     * @Route("/dashboard/delete-project/{id}")
     * @Method({"DELETE"})
     */
    public function deleteProject(Request $request, $id){
        $project = $this->getDoctrine()->getRepository
        (Project::class)->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($project);
        $manager->flush();

        $response = new Response();
        $response->send();


    }

}
