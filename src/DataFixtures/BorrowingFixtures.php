<?php

namespace App\DataFixtures;

use App\Entity\Borrowing;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BorrowingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create("fr_FR");

        for ($i=0; $i < 20; $i++) { 
            $borrowing = new Borrowing();
            $borrowing->setBorrowAt(new \DateTimeImmutable);
            $borrowing->setExpectedReturnDate(new \DateTime);
            $borrowing->setActualReturnDate(new \DateTime);
            $borrowing->setComment($faker->realText);

            $manager->persist($borrowing);
        }

        $manager->flush();
    }
}
