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
use Symfony\Component\HttpFoundation\Request;











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
        $demo = new EntityDemo();

        
        $form = $this->createFormBuilder( $demo)
            ->add('title',  TextType::class , [ 
                'attr' => 
                [ 'class' => 'form-control']
                ] )
            ->add('matricule', TextType::class , [ 
                'attr' => 
                [ 'class' => 'form-control']
                ] )
            ->add('content', TextareaType::class , [ 
                'attr' => 
                [ 'class' => 'form-control']
                ])
            ->add ('save', SubmitType::class, [
                'label' => 'Create',
                'attr' => [
                    'class' => 'btn btn-primary' 
                ]

            ])
            // add a createdAt  input in hidden mode
            
            
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $demo = $form->getData();
            $manager->persist($demo);
            $manager->flush();
            return $this->redirectToRoute('app_demo');
        }

        return $this->render('demo/create.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }

}
