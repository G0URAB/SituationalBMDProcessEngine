<?php

namespace App\Form;

use App\Entity\BusinessComponent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusinessComponentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name",TextType::class,[
                'disabled'=>true
            ])
            ->add('businessTexts', CollectionType::class,[
                'label'=>"Add Values",
                'entry_type' => BusinessTextType::class,
                'entry_options'=>[
                    'label'=>false
                ],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype' => true,
                'by_reference' => false,
            ])
            ->add("log",TextareaType::class,[
                'disabled'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BusinessComponent::class,
        ]);
    }
}
