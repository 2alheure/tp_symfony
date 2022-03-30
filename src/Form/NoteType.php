<?php

namespace App\Form;

use App\Entity\Note;
use App\Entity\Eleve;
use App\Entity\Matiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Range;

class NoteType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('note', NumberType::class, [
                'constraints' => [
                    new Range([
                        'min' => 0,
                        'max' => 20
                    ])
                ]
            ])
            ->add('coefficient', NumberType::class)
            ->add('date', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('matiere', EntityType::class, [
                'label' => 'Matière',
                'class' => Matiere::class,
                'choice_label' => 'nom'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
