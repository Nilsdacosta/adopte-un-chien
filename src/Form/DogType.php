<?php

namespace App\Form;

use App\Entity\Breed;
use App\Entity\Dog;
use App\Entity\Picture;
use App\Repository\PictureRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => "Nom du chien"
            ] )
            ->add('dateOB', DateType::class,[
                'label' => "Date de naissance"
            ])
            ->add('history', TextareaType::class,[
                'label' => "Son histoire"
            ])
            ->add('lof', ChoiceType::class,[
                'label' => "LOF",
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'expanded' => true
            ])
            ->add('acceptCats', ChoiceType::class,[
                'label' => "Accepte t\'il nos amis les chats",
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'expanded' => true
            ])
            ->add('acceptDogs', ChoiceType::class,[
                'label' => "Accepte t\'il ses amis les chiens",
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'expanded' => true
            ])
            ->add('isAdopted', ChoiceType::class,[
                'label' => "Est adopté",
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true
            ])
            ->add('sex', ChoiceType::class,[
                'label' => "Sex",
                'choices' => [
                    'Mâle' => true,
                    'Femelle' => false,
                ],
                'expanded' => true
            ])
            ->add('breeds', EntityType::class,[
                'label' => "Race(s)",
                'class' => Breed::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('pictures', EntityType::class,[
                'label' => "Photo(s)",
                'class' => Picture::class,
                'choice_label' => 'path',
                'multiple' => true,
                'expanded'=>true,
                'query_builder'=> function (PictureRepository $pr){
                return $pr->createQueryBuilder('p') ->andWhere('p.dog IS NULL');
                }
            ])
            //->add('advertisement')
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}
