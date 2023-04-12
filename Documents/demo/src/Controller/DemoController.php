<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\EntityDemo;
use App\Repository\EntityDemoRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use DateTimeImmutable;
use DateTime;
use Symfony\Component\Form\Extension\Core\Type\TimeType;















class DemoController extends AbstractController
{

    #[Route('/demo', name: 'app_demo')]
    public function index(): Response
    {
        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
            
        ]);
    }
    #[Route('/home', name: 'app_demo')]
    public function home(EntityDemoRepository $demo): Response
    {
        $demos = $demo->findAll();
        return $this->render('demo/home.html.twig', [

            'title' => 'home',
            'age' => 0 , 
            'demos' => $demos
        ]);
    }
    #[Route('/show/{id}', name: 'show_app')]
    public function show(EntityManagerInterface  $em, $id): Response
    {
        $sh = $em->getRepository(EntityDemo::class);
        $show = $sh->find($id);
        return $this->render('demo/show.html.twig', [

            'sh' => $show,
            'age' => 0 ,
        ]);
    }

    #[Route('/Create_app', name: 'create_app')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        
        // creation d'une date par defaut
        $defaultDate = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
 

        // dump($request );
        
        if ($request->request->count() > 0) {
            # code...
            $demo = new EntityDemo();
            $demo->setTitle($request->request->get('title'));
            $demo->setMatricule($request->request->get('matricule'));
            $demo->setContent($request->request->get('content'));
            $demo->setCreatedAt($defaultDate);
            $manager->persist($demo);
            $manager->flush();
            return $this->redirectToRoute('app_demo');
           
        }
        return $this->render('demo/create.html.twig', [
            'title' => 'Create Post',
            'age' => 0 ,

        ]);
    
    }
    #[Route('/test', name: 'test_app')]
    public function test(): Response
    {
        $date = new DateTime('2023-04-12 15:30:00');
        $date->format('Y-m-d H:i:s'); // outputs "2023-04-12 15:30:00";
        return $this->render('demo/dateTest.html.twig', [
            'date' => $date,
            
        ]);
        
    }

}
