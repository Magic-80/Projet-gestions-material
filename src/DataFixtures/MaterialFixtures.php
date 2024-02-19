<?php

namespace App\DataFixtures;

use App\Entity\Material;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MaterialFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");

        for ($i=0; $i < 20; $i++) { 
            $material = new Material();
            $material->setName($faker->word);
            $material->setComment($faker->realText);    
            $material->setLocation($faker->locale);
            $material->setSerialNumber($faker->regexify('[A-Z]{5}[0-4]{3}'));
            $material->setTagNumber($faker->regexify('[A-Z]{8}[0-2]{5}'));

            $manager->persist($material);
        }

        $manager->flush();
    }
}
