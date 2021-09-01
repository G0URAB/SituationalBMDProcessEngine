<?php

namespace App\Form;

use App\Entity\SituationalFactor;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SituationalFactorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
            ])
            ->add('variants',CollectionType::class,[
                'label'=>"Values",
                'entry_type' => TextType::class,
                'entry_options'=>[
                    'label'=>false
                ],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype' => true,
            ])
            ->add("add_variant",ButtonType::class,[
                'label'=>'Add Value'
            ])
            ->add('description',CKEditorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SituationalFactor::class,
        ]);
    }
}
