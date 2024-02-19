<?php

namespace App\DataFixtures;

use App\Entity\TrainingProgram;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TrainingProgramFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");

       for ($i=0; $i < 15; $i++) { 
            $training = new TrainingProgram();
            $training->setName($faker->name);
            $training->setLevel($faker->word);

            $manager->persist($training);
       }

        $manager->flush();
    }
}
