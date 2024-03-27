<?php

namespace App\Form;

use App\Entity\Borrowing;
use App\Entity\Employee;
use App\Entity\Material;
use App\Entity\Student;
use App\Entity\TrainingProgram;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BorrowingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('borrowAt')
            ->add('expectedReturnDate')
            ->add('actualReturnDate')
            ->add('comment')
            ->add('manage', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'id',
            ])
            ->add('borrow', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'id',
            ])
            ->add('relateTo', EntityType::class, [
                'class' => Material::class,
                'choice_label' => 'id',
            ])
            ->add('trainingProgram', EntityType::class, [
                'class' => TrainingProgram::class,
                'choice_label' => 'id',
            ])
            ->add('student', EntityType::class, [
                'class' => Student::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Borrowing::class,
        ]);
    }
}
