<?php

namespace App\Form;

use App\Entity\Borrowing;
use App\Entity\Employee;
use App\Entity\Material;
use App\Entity\Student;
use App\Entity\TrainingProgram;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BorrowingFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('relateTo', EntityType::class, [
                'label' => 'Élément emprunté (n° étiquette)',
                'class' => Material::class,
                'choice_label' => 'tagNumber',
                'attr' => ['class' => 'custom-input'],
            ])
            // Autres champs de formulaire
            ->add('borrowAt', DateType::class, [
                'label' => 'Date d\'emprunt',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'custom-input'],
            ])
            ->add('borrow', EntityType::class, [
                'label' => 'Emprunteur',
                'class' => Employee::class, // Si 'borrow' fait référence à un employé
                 //'class' => Student::class, // Si 'borrow' fait référence à un étudiant
                'choice_label' => function (Employee $employee) {
                    return $employee->getFirstname(); // Méthode pour obtenir le nom complet de l'employé
                },
                // 'choice_label' => 'name', // Si 'borrow' fait référence à un étudiant, utiliser le nom
                'attr' => ['class' => 'custom-input'],
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Commentaire',
                'attr' => ['class' => 'custom-input'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Borrowing::class,
        ]);
    }
}

