<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");

        for ($i=0; $i < 10; $i++) { 
            $employee = new Employee();
            $employee->setFirstname($faker->firstName);
            $employee->setLastname($faker->lastName);
            $employee->setPassword($faker->password);
            $employee->setRoles($faker->jobTitle);
            $employee->setUsername($faker->userName);
            $employee->setDeactivate($faker->boolean);

            $manager->persist($employee);
        }

        $manager->flush();
    }
}
