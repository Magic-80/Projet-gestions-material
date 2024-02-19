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

        $employee = new Employee();
        $employee->setFirstname($faker->firstName);
        $employee->setLastname($faker->lastName);
        $employee->setPassword($faker->password);
        $employee->setRoles($faker->text());
        $employee->setUsername($faker->text());
        $employee->setDeactivate($faker->boolean);

        $manager->persist($employee);

        $manager->flush();
    }
}
