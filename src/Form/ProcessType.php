<?php

namespace App\Form;

use App\Entity\Artifact;
use App\Entity\Process;
use App\Entity\Role;
use App\Entity\SituationalFactor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label_attr'=>['class'=>"font-weight-bold"],
            ])
            ->add('roles', EntityType::class, [
                'label_attr'=>['class'=>"font-weight-bold"],
                'class' => Role::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('artifacts',EntityType::class, [
                'label_attr'=>['class'=>"font-weight-bold"],
                'class' => Artifact::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('situationalFactors',EntityType::class, [
                'label_attr'=>['class'=>"font-weight-bold"],
                'class' => SituationalFactor::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('genericActivity',ChoiceType::class,[
                'label_attr'=>['class'=>"font-weight-bold"],
                'choices'=> $options['genericActivities'],
                'choice_label' => 'name',
                'placeholder' => 'Select a generic activity',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Process::class,
            'genericActivities' => null,
            'roles' => null,
            'artifacts' => null,
            'situationalFactors' => null,
        ]);
    }
}
