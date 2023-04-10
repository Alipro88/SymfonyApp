<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\EntityDemo;
use App\Repository\EntityDemoRepository;

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


}
