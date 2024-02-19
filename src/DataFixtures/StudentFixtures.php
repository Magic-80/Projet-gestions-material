<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");

        $student = new Student();
        $student->setFirstname($faker->firstName);
        $student->setLastname($faker->lastName);
        $student->setBirthdate(new \DateTime);

        $manager->persist($student);

        $manager->flush();
    }
}
