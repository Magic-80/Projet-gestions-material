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

        $training = new TrainingProgram();
        $training->setName($faker->name);
        $training->setLevel($faker->text());

        $manager->persist($training);

        $manager->flush();
    }
}
