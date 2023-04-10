<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\EntityDemo;

class DemoFix extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i <= 10 ; $i++) { 
            $demo = new EntityDemo();
            $demo->setTitle('Titre de poste  '.$i);
            $demo->setMatricule('Matricule de poste '.$i);
            $demo->setCreatedAt(new \DateTimeImmutable());
            $demo->setContent('Content '.$i);
            $manager->persist($demo);
            
        }

        $manager->flush();
    }
}
