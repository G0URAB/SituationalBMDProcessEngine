<?php

namespace App\Form;


use App\Entity\Process;
use App\Entity\ProcessKind;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProcessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Process Name',
                'label_attr'=>['class'=>"font-weight-bold"],
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
            ])
            ->add('parentProcessKind',EntityType::class,[
                'label'=> "Parent Process Type",
                'placeholder'=> 'Please select a parent process type',
                'class' => ProcessKind::class,
                'required'=> true,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('otherRelatedProcessKinds',EntityType::class,[
                'label'=> "In which other process types can it be used? (Hold control to select multiple types)",
                'class' => ProcessKind::class,
                'placeholder'=> "Select other related process types",
                'empty_data' => '',
                'multiple' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Process::class,
        ]);
    }
}
