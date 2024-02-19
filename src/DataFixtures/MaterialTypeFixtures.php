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

        for ($i=0; $i < 20; $i++) { 
            $materialType = new MaterialType();
            $materialType->setName($faker->word);
        
            $manager->persist($materialType);
        }

        $manager->flush();
    }
}
