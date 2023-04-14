<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\EntityDemo;

class DemoFix extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = \Faker\Factory::create('fr_FR');

        //create 3 categories  faker
         for  ($i=0; $i <= 2 ; $i++) { 
            $category = new Category();
            $category->setTitle($faker->sentence());
            $category->setDescription($faker->paragraph());
            $manager->persist($category);
            
                

        for ($k=0; $k <= 11 ; $k++) { 

            $content = '<p>'. join($faker->paragraphs(5), '</p><p>') .'</p>'; 
            $demo = new EntityDemo();
            $demo->setTitle($faker ->sentence());
            $demo->setMatricule('Matricule de poste '.$k);
            $demo->setCreatedAt($faker->dateTimeBetween('-6 months'));
            $demo-> setCategory($category);
            $demo->setContent($content);
            $manager->persist($demo);
            
        }
        for ($j=0; $j <= 5 ; $j++) { 
            $coment = new Comment();
            $coment->setAuthor($faker->name());
            $coment->setContent($faker->paragraph());
            $coment->setCreatedAt($faker->dateTimeBetween('-6 months'));
            $coment->setEntityDemo($demo);
            $manager->persist($coment);
            
            
        }

        $manager->flush();
    }
}
