<?php

namespace App\Form;

use App\Entity\BusinessModelDefinition;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BusinessModelDefinitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',TextType::class,[
                'label'=> "Name Of Business Model Definition",
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
            ])
            ->add('components',CollectionType::class,[
                'label'=>"Business Model Components",
                'entry_type' => TextType::class,
                'entry_options'=>[
                    'label'=>false
                ],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype' => true,
                'by_reference' => false
            ])
            ->add("add_component",ButtonType::class,[
                'label'=>'Add Component'
            ])
            ->add('description',CKEditorType::class,[
                'config' => array(
                    'height' => '350px',
                    //...
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => BusinessModelDefinition::class,
        ]);
    }
}
