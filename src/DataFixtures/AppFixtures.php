<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\Borrowing;
use App\Entity\Material;
use App\Entity\MaterialType;
use App\Entity\TrainingProgram;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $faker = \Faker\Factory::create("fr_FR");

         // Création de types de matériel
         $materialTypes = [];
         for ($i = 0; $i < 10; $i++) {
             $materialType = new MaterialType();
             $materialType->setName($faker->word);
             $manager->persist($materialType);
             $materialTypes[] = $materialType;
         }
 
         // Création d'étudiants
         $students = [];
         for ($i = 0; $i < 10; $i++) {
             $student = new Student();
             $student->setFirstname($faker->firstName);
             $student->setLastname($faker->lastName);
             $student->setBirthdate($faker->dateTimeThisCentury);
             $manager->persist($student);
             $students[] = $student;
         }
 
         // Création de programmes de formation
         $trainingPrograms = [];
         for ($i = 0; $i < 10; $i++) {
             $trainingProgram = new TrainingProgram();
             $trainingProgram->setName($faker->word);
             $trainingProgram->setLevel($faker->randomElement(['B1', 'B2', 'B3' , 'M1' , 'M2']));
             $manager->persist($trainingProgram);
             $trainingPrograms[] = $trainingProgram;
         }
 
         // Création d'employés
         $employees = [];
         for ($i = 0; $i < 10; $i++) {
             $employee = new Employee();
             $employee->setLastname($faker->lastName);
             $employee->setFirstname($faker->firstName);
             $employee->setPassword($faker->password);
             $employee->setRoles($faker->randomElement(["Admin" , "Student" , "Prof"]));
             $employee->setUsername($faker->userName);
             $manager->persist($employee);
             $employees[] = $employee;
         }
 
         // Création de matériel avec des relations
         for ($i = 0; $i < 20; $i++) {
             $material = new Material();
             $material->setName($faker->word);
             $material->setSerialNumber($faker->regexify('[A-Z]{5}[0-4]{3}'));
             $material->setTagNumber($faker->regexify('[A-Z]{8}[0-2]{5}'));
             $material->setComment($faker->sentence);
             $material->setLocation($faker->word);
 
             // Associer le type de matériel
             $material->setMaterialType($faker->randomElement($materialTypes));
 
             $manager->persist($material);
 
             // Création d'emprunts avec des relations
             $borrowing = new Borrowing();
             $borrowing->setBorrowAt($faker->dateTimeThisMonth);
             $borrowing->setExpectedReturnDate($faker->dateTimeThisMonth);
             $borrowing->setActualReturnDate($faker->dateTimeThisMonth);
             $borrowing->setComment($faker->sentence);
 
             // Associer l'employé et le matériel
             $borrowing->setManage($faker->randomElement($employees));
             $borrowing->setRelateTo($material);
 
             // Associer le programme de formation et l'étudiant
             $borrowing->setTrainingProgram($faker->randomElement($trainingPrograms));
             $borrowing->setStudent($faker->randomElement($students));
 
             $manager->persist($borrowing);
         }
 
         $manager->flush();
    }
}
