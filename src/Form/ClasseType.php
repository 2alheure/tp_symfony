<?php

namespace App\Form;

use App\Entity\Prof;
use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClasseType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('nom', TextType::class)
            ->add('niveau', ChoiceType::class, [
                'choices' => [
                    '6e' => '6e',
                    '5e' => '5e',
                    '4e' => '4e',
                    '3e' => '3e',
                ],
                'multiple' => false
            ])
            ->add('profPrincipal', EntityType::class, [
                'class' => Prof::class,
                'choice_label' => 'nomEtPrenom'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
