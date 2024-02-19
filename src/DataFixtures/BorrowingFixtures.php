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

        $borrowing = new Borrowing();
        $borrowing->setBorrowAt(new \DateTimeImmutable);
        $borrowing->setExpectedReturnDate(new \DateTime);
        $borrowing->setActualReturnDate(new \DateTime);
        $borrowing->setComment($faker->text());

        $manager->persist($borrowing);

        $manager->flush();
    }
}
