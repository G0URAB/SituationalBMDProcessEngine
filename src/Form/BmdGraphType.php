<?php

namespace App\Form;

use App\Entity\BmdGraph;
use App\Entity\ProcessKind;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class BmdGraphType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name",TextType::class,[
                'label'=>"Name of the Bmd Graph",
                'required'=>true,
                'attr'=>[
                    'placeholder' =>"Apple Handset Business Graph",
                    'autocomplete'=> "off"
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
            ])
            ->add('situationalFactors', ChoiceType::class, [
                'label' => 'Situational Factors',
                'choices' => $options['situationalChoices'],
                'multiple' => true,
                'placeholder' => 'Select situational factors',
                'required' => true
            ])
            ->add('parentProcessKind',EntityType::class,[
                'label'=> "Parent Process Type",
                'class' => ProcessKind::class,
                'placeholder'=> "Select a parent process type"
            ])
            ->add('saveGraph',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BmdGraph::class,
            'situationalChoices'=> null,

            //We are providing protection manually at the frontend through {{ csrf_token('bmd-graph') }}
            'csrf_protection' => false,
        ]);
    }
}
