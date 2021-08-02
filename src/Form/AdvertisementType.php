<?php

namespace App\Form;

use App\Entity\Advertisement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertisementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('updateDate')
            ->add('isActive')
            ->add('description')
            ->add('dogs', CollectionType::class,[
                // 'attr' => ['text' => 'name'],
                // 'name', TextType::class
                // 'entry_type' => TextType::class,
                // 'entry_options'=> [
                //     'attr' => ['text' => 'name']
                // ],
                // 'entry_type' => DateType::class,
            ])
            //->add('announcer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advertisement::class,
        ]);
    }
}
