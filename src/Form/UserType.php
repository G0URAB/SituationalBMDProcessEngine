<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('employeeName', TextType::class,[
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
                'attr'=>[
                    'autocomplete'=>'off'
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=> 'Email of the employee',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
                'attr'=>[
                    'autocomplete'=>'off'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => $this->getRoles(),
                'placeholder' => "Please select a role for this team member",
                'required' => true
            ])
            ->add('password', PasswordType::class)
            ->add('add', SubmitType::class);

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray) ? $rolesArray[0] : null;
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    public function getRoles($exceptProjectManager = false)
    {
        $allRoles = [
            'Project Manager' => 'ROLE_PROJECT_MANAGER',
            'Method Engineer' => 'ROLE_METHOD_ENGINEER',
            'Web Developer' => 'ROLE_WEB_DEVELOPER',
            'Marketing Executive' => 'ROLE_MARKETING_EXECUTIVE',
            'Marketing Manager' => 'ROLE_MARKETING_MANAGER',
            'Marketing VP' => 'ROLE_MARKETING_VP',
            'Sales Executive' => 'ROLE_SALES_EXECUTIVE',
            'Sales Manager' => 'ROLE_SALES_MANAGER',
            'Sales VP' => 'ROLE_SALES_VP',
            'Customer' => 'ROLE_CUSTOMER',
            'Platform Owner' => 'ROLE_PLATFORM_OWNER'
        ];

        if($exceptProjectManager)
            return array_shift($allRoles);

        return $allRoles;
    }
}
