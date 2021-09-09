<?php

namespace App\Form;

use App\Entity\BusinessModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusinessModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('segments', CollectionType::class,[
                'entry_type' => BusinessSegmentType::class,
                'entry_options' => ['label' => false],
                'allow_add' => false,
                'allow_delete' => false,
            ])
            ->add("submit",SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BusinessModel::class,
            'csrf_protection' => false,
        ]);
    }
}
