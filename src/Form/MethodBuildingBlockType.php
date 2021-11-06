<?php

namespace App\Form;

use App\Entity\MethodBuildingBlock;
use App\Entity\Process;
use App\Entity\Role;
use App\Entity\Tool;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MethodBuildingBlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('process', EntityType::class, [
                'class' => Process::class,
                'placeholder' => 'Select a process',
                'required' => true
            ])
            ->add('inputArtifacts', ChoiceType::class, [
                'label' => 'Input Artifacts',
                'choices' => $options['artifactChoices'],
                'multiple' => true,
                'required' => false,
            ])
            ->add('outputArtifacts', ChoiceType::class, [
                'label' => 'Output Artifacts',
                'choices' => $options['artifactChoices'],
                'multiple' => true,
                'required' => false,
            ])
            ->add('roles', EntityType::class, [
                'label' => 'Roles',
                'class' => Role::class,
                'multiple' => true,
                'required' => true
            ])
            ->add('tools', EntityType::class, [
                'label' => 'Tools',
                'class' => Tool::class,
                'multiple' => true,
                'required'=> false
            ])
            ->add('situationalFactors', ChoiceType::class, [
                'label' => 'Situational Factors',
                'choices' => $options['situationalChoices'],
                'multiple' => true,
                'placeholder' => 'All situations',
                'required' => true
            ])
            ->add('businessModelComponents', ChoiceType::class, [
                'label' => 'Business Model Components',
                'choices' => $options['businessComponentChoices'],
                'multiple' => true,
                'placeholder' => 'All Business Model Components',
                'required' => false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MethodBuildingBlock::class,
            'situationalChoices' => null,
            'artifactChoices' => null,
            'businessComponentChoices' => null
        ]);
    }
}
