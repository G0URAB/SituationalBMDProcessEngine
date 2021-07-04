<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationController extends AbstractController
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request): Response
    {
        $registrationForm = null;
        $newUser = new User();
        $totalUsers = $this->getDoctrine()->getRepository(User::class)->findAll();
        $entityManager = $this->getDoctrine()->getManager();

        if (count($totalUsers) > 0) {
            $registrationForm = $this->createFormBuilder($newUser)
                ->add('employeeName', TextType::class, [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 5]),
                    ],
                ])
                ->add('email', EmailType::class, [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 5]),
                    ],
                ])
                ->add('roles', ChoiceType::class, [
                    'choices' => [
                        'Project Manager' => ['ROLE_PROJECT_MANAGER'],
                        'Method Engineer' => ['ROLE_METHOD_ENGINEER']
                    ]
                ])
                ->add('submit',SubmitType::class)
                ->getForm();
        } else {
            $registrationForm = $this->createFormBuilder($newUser)
                ->add('organizationName', TextType::class, [
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 4]),
                    ],
                    'attr'=>[
                        'autocomplete'=>'off'
                    ]
                ])
                ->add('employeeName', TextType::class, [
                    'label'=> 'Your name',
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 5]),
                    ],
                    'attr'=>[
                        'autocomplete'=>'off'
                    ]
                ])
                ->add('email', EmailType::class, [
                    'required' => true,
                    'attr'=>[
                        'autocomplete'=>'off'
                    ]
                ])
                ->add('password',RepeatedType::class,[
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options'  => ['label' => 'Password'],
                    'second_options' => ['label' => 'Repeat Password'],
                ])
                ->add('submit',SubmitType::class,[
                    'label'=> 'Create Organization'
                ])
                ->getForm();
        }

        $registrationForm->handleRequest($request);

        if($registrationForm->isSubmitted() && $registrationForm->isValid())
        {
            $this->addFlash('success',"Your account has been created. Please login to use the account!");
            $newUser->setPassword($this->passwordHasher->hashPassword($newUser,$newUser->getPassword()));
            $newUser->setRoles(['ROLE_SUPER_ADMIN']);
            $entityManager->persist($newUser);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }


        return $this->render('security/registration.html.twig', [
            'form' => $registrationForm->createView(),
            'firstUser' => count($totalUsers) == 0
        ]);
    }
}