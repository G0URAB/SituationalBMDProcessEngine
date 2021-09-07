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
                'label'=> "Business Model Type",
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
            ])
            ->add('segments',CollectionType::class,[
                'label'=>"Business Model Segments",
                'entry_type' => TextType::class,
                'entry_options'=>[
                    'label'=>false
                ],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype' => true,
            ])
            ->add("add_segment",ButtonType::class,[
                'label'=>'Add Segment'
            ])
            ->add('description',CKEditorType::class)
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
