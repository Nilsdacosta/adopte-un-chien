<?php

namespace App\Form;

use App\Entity\Breed;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BreedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', TextareaType::class, [
                // On peut ajouter pleins de paramètres
                'required' => true,

                // 'attr' => [
                //     'class' => 'bidule'
                // ]
            ])
            // ->add('dogs')
        ;
        if ($options['submit'] === true) {
            $builder->add('submit', SubmitType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Breed::class,
            'submit' => false,
        ]);
        $resolver->setRequired([
            'submit',
        ]);
    }
}