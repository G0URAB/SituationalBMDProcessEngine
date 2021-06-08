<?php

namespace App\Controller;

use App\Entity\Artifact;
use App\Entity\ProcessKind;
use App\Entity\Process;
use App\Entity\Role;
use App\Entity\SituationalFactor;
use App\Form\ArtifactType;
use App\Form\ProcessKindType;
use App\Form\ProcessType;
use App\Form\RoleType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MethodElementsController extends AbstractController
{

    private $processes;
    private $processKinds;
    private $roles;
    private $artifacts;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->roles = $entityManager->getRepository(Role::class)->findAll();
        $this->artifacts = $entityManager->getRepository(Artifact::class)->findAll();
        $this->processes = $entityManager->getRepository(Process::class)->findAll();
        $this->processKinds = $entityManager->getRepository(ProcessKind::class)->findAll();
    }


    /**
     * @Route("/method_elements", name="methodElements")
     */
    public function index(): Response
    {
        return $this->render('method_elements/index.html.twig', [
            'artifacts' => $this->artifacts,
            'processes' => $this->processes,
            'roles' => $this->roles
        ]);
    }

    /**
     * @Route("/process/create", name="create_process")
     * @param Request $request
     * @return Response
     */
    public function createProcess(Request $request): Response
    {
        $form = $this->createMultiEntityForm('processes',ProcessType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach($form->getData()['processes'] as $process)
            {
                foreach ($this->processes as $existingProcess)
                {
                    if(strcasecmp($existingProcess->getName(), $process->getName())===0)
                    {
                        $form->addError(new FormError($process->getName().' already exists'));
                        return $this->render('method_elements/processes/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }
                $this->entityManager->persist($process);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("methodElements");
        }

        //Notify when there are no processTypes
        if (empty($this->processKinds)) {
            $message = "There are no process types. Please create at least one!!";
            $this->addFlash("danger", $message);
        }

        return $this->render('method_elements/processes/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/role/create", name="create_role")
     * @param Request $request
     * @return Response
     */
    public function createRole(Request $request): Response
    {
        $form = $this->createMultiEntityForm('roles',RoleType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($form->getData()['roles'] as $role)
            {
                foreach ($this->roles as $existingRole)
                {
                    if(strcasecmp($existingRole->getName(), $role->getName())===0)
                    {
                        $form->addError(new FormError($role->getName().' already exists'));
                        return $this->render('method_elements/roles/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }

                $this->entityManager->persist($role);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("methodElements");
        }

        return $this->render('method_elements/roles/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/artifact/create", name="create_artifact")
     * @param Request $request
     * @return Response
     */
    public function createArtifact(Request $request): Response
    {
        $form = $this->createMultiEntityForm('artifacts',ArtifactType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($form->getData()['artifacts'] as $artifact)
            {
                foreach ($this->artifacts as $existingArtifact)
                {
                    if(strcasecmp($existingArtifact->getName(), $artifact->getName())===0)
                    {
                        $form->addError(new FormError($artifact->getName().' already exists'));
                        return $this->render('method_elements/artifacts/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }
                $this->entityManager->persist($artifact);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("methodElements");
        }

        return $this->render('method_elements/artifacts/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/process_type/create", name="create_process_type")
     * @param Request $request
     * @return Response
     */
    public function createProcessKind(Request $request): Response
    {
        $form = $this->createMultiEntityForm('processKinds',ProcessKindType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($form->getData()['processKinds'] as $processKind)
            {
                $this->entityManager->persist($processKind);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("methodElements");
        }

        return $this->render('method_elements/process_types/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function createMultiEntityForm(string $multiEntityFormat, $formType)
    {
        return $this->createFormBuilder()
            ->add($multiEntityFormat,CollectionType::class,[
                'label'=>false,
                'entry_type' => $formType,
                'entry_options'=>[
                  'label'=>false
                ],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype' => true,
                'error_bubbling'=>false
            ])
            ->add('Submit',SubmitType::class)
            ->getForm();
    }

}
