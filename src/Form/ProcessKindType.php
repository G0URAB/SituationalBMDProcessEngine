<?php

namespace App\Form;

use App\Entity\ProcessKind;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProcessKindType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label'=>'Name of process type',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 4]),
                ],
            ])
            ->add('description',CKEditorType::class)
            ->add('parentProcessKind', EntityType::class,[
                'required'=>false,
                'label'=> "Parent Process Type",
                'class' => ProcessKind::class,
                'placeholder'=> "Select a parent process type"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProcessKind::class,
        ]);
    }
}
