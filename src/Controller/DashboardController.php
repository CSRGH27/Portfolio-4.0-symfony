<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Entity\Degree;
use App\Form\DegreeType;
use App\Repository\DegreeRepository;

use App\Entity\Work;
use App\Form\WorkType;
use App\Repository\WorkRepository;

use App\Entity\Language;
use App\Form\SkillType;
use App\Repository\LanguageRepository;
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
        return $this->render('dashboard/base_dash.html.twig', [
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

    /**
     * @Route("/dashboard/list-degree", name="list_degree")
     */
    public function listDegree(DegreeRepository $repo){
        $degree = $repo->findAll();
        return $this->render('dashboard/list-degree.html.twig', [
            'controller_name' => 'DashboardController',
            'degrees' => $degree,
        ]);
    }

    /**
     * @Route("/dashboard/new-degree", name="create_degree")
     */
    public function createDegree(Request $request, ObjectManager $manager){
        $degree = new Degree();
            
        $form = $this->createForm(DegreeType::class, $degree);
        $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()){
            
           $manager->persist($degree);
           $manager->flush();
           return $this->redirectToRoute('list_degree');
            
        }   
        return $this->render('dashboard/new-degree.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/dashboard/edit-degree/{id}", name="edit_degree")
     */
    public function editDegree(Request $request, ObjectManager $manager, $id){
        $degree = new Degree();
        $degree = $this->getDoctrine()->getRepository
        (Degree::class)->find($id);
            
        $form = $this->createForm(DegreeType::class, $degree);
        $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()){
            
           $manager = $this->getDoctrine()->getManager();
           $manager->persist($degree);
           $manager->flush();
           return $this->redirectToRoute('list_degree');
            
        }   
        return $this->render('dashboard/edit-degree.html.twig',[
            'form' => $form->createView(),
            'degree' =>$degree,
        ]);
    }
    /**
     * @Route("/dashboard/list-work", name="list_work")
     */
    public function listWork(WorkRepository $repo){
        $work = $repo->findAll();
        return $this->render('dashboard/list-work.html.twig', [
            'controller_name' => 'DashboardController',
            'works' => $work,
        ]);
    }

    /**
     * @Route("/dashboard/new-work", name="create_work")
     */
    public function createWork(Request $request, ObjectManager $manager){
        $work = new Work();
            
        $form = $this->createForm(WorkType::class, $work);
        $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()){
            
           $manager->persist($work);
           $manager->flush();
           return $this->redirectToRoute('list_work');
            
        }   
        return $this->render('dashboard/new-work.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/dashboard/edit-work/{id}", name="edit_work")
     */
    public function editWork(Request $request, ObjectManager $manager, $id){
        $work = new Work();
        $work = $this->getDoctrine()->getRepository
        (Work::class)->find($id);
            
        $form = $this->createForm(WorkType::class, $work);
        $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()){
            
           $manager = $this->getDoctrine()->getManager();
           $manager->persist($work);
           $manager->flush();
           return $this->redirectToRoute('list_work');
            
        }   
        return $this->render('dashboard/edit-work.html.twig',[
            'form' => $form->createView(),
            'work' =>$work,
        ]);
    }

    /**
     * @Route("/dashboard/list-skill", name="list_skill")
     */
    public function listSkill(LanguageRepository $repo){
        $skill = $repo->findAll();
        return $this->render('dashboard/list-skill.html.twig', [
            'controller_name' => 'DashboardController',
            'skills' => $skill,
        ]);
    }

     /**
     * @Route("/dashboard/new-skill", name="create_skill")
     */
    public function createSkill(Request $request, ObjectManager $manager){
        $skill = new Language();
            
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()){
            
           $manager->persist($skill);
           $manager->flush();
           return $this->redirectToRoute('list_skill');
            
        }   
        return $this->render('dashboard/new-skill.html.twig',[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/dashboard/edit-skill/{id}", name="edit_skill")
     */
    public function editSkill(Request $request, ObjectManager $manager, $id){
        $skill = new Language();
        $skill = $this->getDoctrine()->getRepository
        (Language::class)->find($id);
            
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);
           
        if ($form->isSubmitted() && $form->isValid()){
            
           $manager = $this->getDoctrine()->getManager();
           $manager->persist($skill);
           $manager->flush();
           return $this->redirectToRoute('list_skill');
            
        }   
        return $this->render('dashboard/edit-skill.html.twig',[
            'form' => $form->createView(),
            'skill' =>$skill,
        ]);
    }

    

    

}
