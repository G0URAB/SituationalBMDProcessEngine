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
            ->add('processKinds',EntityType::class,[
                'label'=> "Process Types",
                'class' => ProcessKind::class,
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Process::class,
            'processKinds' => null,
        ]);
    }
}
