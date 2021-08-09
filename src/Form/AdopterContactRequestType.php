<?php

namespace App\Form;

use App\Entity\Adopter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdopterContactRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phoneNumber', TelType::class, [
                'label' => 'Numéro de téléphone', 'required'=>true])
            ->add('name', TextType::class, [
                'label' => 'Nom de famille', 'required'=>true
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom', 'required'=>true
            ])
            ->add('address', AddressType::class, ['label'=>'Votre adresse postale : ', 'required'=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adopter::class,
        ]);
    }
}
