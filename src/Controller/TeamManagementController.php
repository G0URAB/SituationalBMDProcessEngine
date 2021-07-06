<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TeamManagementController extends AbstractController
{
    private $passwordHasher;
    private $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $registrationForm = null;
        $newUser = new User();

        $registrationForm = $this->createFormBuilder($newUser)

            ->add('employeeName', TextType::class, [
                'label' => 'Your name',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 5]),
                ],
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => [
                    'autocomplete' => 'off'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Create Organization'
            ])
            ->getForm();


        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $this->addFlash('success', "Your account has been created. Please login to use the account!");
            $newUser->setPassword($this->passwordHasher->hashPassword($newUser, $newUser->getPassword()));
            $newUser->setRoles(['ROLE_SUPER_ADMIN']);
            $this->entityManager->persist($newUser);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/start_bmd.html.twig', [
            'form' => $registrationForm->createView(),
        ]);
    }

    /**
     * @Route("/team/member/add", name="add_team_member")
     * @param Request $request
     * @return Response
     */
    public function addTeam(Request $request): Response
    {
        $member = new User();
        $memberForm = $this->createForm(UserType::class, $member);
        $memberForm->handleRequest($request);

        if($memberForm->isSubmitted() && $memberForm->isValid())
        {
            $this->addFlash('success', "The team member's account has been created!");
            $member->setPassword($this->passwordHasher->hashPassword($member, $member->getPassword()));
            $this->entityManager->persist($member);
            $this->entityManager->flush();

            return $this->redirectToRoute('show_team_members');
        }

        return $this->render('security/add_member.html.twig', [
            'form' => $memberForm->createView(),
        ]);
    }

    /**
     * @Route("/team/show", name="show_team_members")
     * @param Request $request
     * @return Response
     */
    public function showTeam(Request $request): Response
    {
        $totalUsers = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('security/show_members.html.twig',[
            'allUsers'=>$totalUsers
        ]);
    }

    /**
     * @Route("/team/member/{id}", name="edit_team_member")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editTeamMember(Request $request, int $id): Response
    {
        $member = $this->entityManager->getRepository(User::class)->find($id);

        $memberForm = $this->createForm(UserType::class, $member);

        $memberForm->handleRequest($request);
        if($memberForm->isSubmitted() && $memberForm->isValid())
        {
            $this->addFlash('success', "The team member's account has been updated!");
            $member->setPassword($this->passwordHasher->hashPassword($member, $member->getPassword()));
            $member->setPasswordResetCounter(0);
            $this->entityManager->persist($member);
            $this->entityManager->flush();

            return $this->redirectToRoute('show_team_members');
        }

        return $this->render('security/edit_members.html.twig', [
            'form' => $memberForm->createView(),
        ]);
    }

    /**
     * @Route("/change_password", name="change_own_password")
     * @param Request $request
     * @return Response
     */
    public function changePassword(Request $request)
    {
        /* @var User $user */
        $user = $this->getUser();

        $form = $this->createFormBuilder()
            ->add('oldPassword', PasswordType::class,[
                'label'=>'Old Password',
                'required'=>true
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'New Password'],
                'second_options' => ['label' => 'Repeat New Password'],
            ])
            ->add('submit', SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $oldPassword = $form->getData()['oldPassword'];
            $newPassword = $form->getData()['newPassword'];
            if(!$this->passwordHasher->isPasswordValid($user, $oldPassword))
              $form->addError(new FormError('Your old password is incorrect!'));
            else
            {
                $user->setPassword($this->passwordHasher->hashPassword(
                    $user,
                    $newPassword
                ));
                $user->setPasswordResetCounter(1);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $this->addFlash("success", "Your password was changed");
                return $this->redirectToRoute('show_team_members');
            }
        }

        return $this->render('security/change_password.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}