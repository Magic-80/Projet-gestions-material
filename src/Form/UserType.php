<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('username')
            ->add('password', PasswordType::class, [
                'required' => false, // Rendre le champ non requis
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Role 1' => 'ROLE_1',
                    'Role 2' => 'ROLE_2',
                    // Ajoutez d'autres rôles si nécessaire
                ],
                'multiple' => true, // Permettre à l'utilisateur de sélectionner plusieurs rôles
                'attr' => ['class' => 'form-control']
            ])
            ->add('deactivate')
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}