<?php

namespace App\DataFixtures;

use App\Entity\MaterialType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MaterialTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");

        $materialType = new MaterialType();
        $materialType->setName($faker->name);
        
        $manager->persist($materialType);

        $manager->flush();
    }
}
