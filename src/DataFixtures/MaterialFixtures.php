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

        $material = new Material();
        $material->setName($faker->name);
        $material->setComment($faker->realText);
        $material->setLocation($faker->text());
        $material->setSerialNumber($faker->text());
        $material->setTagNumber($faker->text());

        $manager->persist($material);

        $manager->flush();
    }
}
