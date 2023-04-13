<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;







class SecurityController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function registration(request $request , EntityManagerInterface $manager ,UserPasswordEncoderInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('app_login');
            
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]
        );
    }
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('demo/login.html.twig');
    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        return $this->render('demo/login.html.twig');
    }

    
}
