<?php

namespace App\Form;

use App\Entity\BusinessSegment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BusinessSegmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name",TextType::class,[
                'disabled'=>true
            ])
            ->add('values', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
                'attr'=> ['autocomplete' => 'off']
            ])
            ->add("log",TextareaType::class,[
                'disabled'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BusinessSegment::class,
        ]);
    }
}
