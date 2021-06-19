<?php

namespace App\Controller;

use App\Entity\Artifact;
use App\Entity\ProcessKind;
use App\Entity\Process;
use App\Entity\Role;
use App\Entity\SituationalFactor;
use App\Entity\Tool;
use App\Form\ArtifactType;
use App\Form\ProcessKindType;
use App\Form\ProcessType;
use App\Form\RoleType;
use App\Form\SituationalFactorType;
use App\Form\ToolType;
use App\Service\DataService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MethodElementsController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }


    /**
     * @Route("/method_elements", name="method_elements")
     * @param DataService $dataService
     * @return Response
     */
    public function index(DataService $dataService): Response
    {
        return $this->render('method_elements/index.html.twig', [
            'artifacts' => $dataService->getAllArtifacts(),
            'processes' => $dataService->getAllProcesses(),
            'processTypes' => $dataService->getAllProcessTypes(),
            'roles' => $dataService->getAllRoles(),
            'situationalFactors' => $dataService->getAllSituationalFactors(),
            'tools' => $dataService->getAllTools()
        ]);
    }

    /**
     * @Route("/method_elements/process/create", name="create_process")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function createProcess(Request $request, DataService $dataService): Response
    {
        $form = $this->createMultiEntityForm('processes', ProcessType::class);
        $childAndParentProcessTypes = [];

        foreach ($dataService->getAllProcessTypes() as $kind) {
            if ($kind->getParentProcessKind())
                $childAndParentProcessTypes[$kind->getName()] = $kind->getParentProcessKind()->getName();
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()['processes'] as $process) {
                foreach ($dataService->getAllProcesses() as $existingProcess) {
                    if (strcasecmp($existingProcess->getName(), $process->getName()) === 0) {
                        $form->addError(new FormError($process->getName() . ' already exists'));
                        return $this->render('method_elements/processes/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }
                $this->entityManager->persist($process);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("method_elements");
        }

        //Notify when there are no processTypes
        if (empty($this->processKinds)) {
            $message = "There are no process types. Please create at least one!!";
            $this->addFlash("danger", $message);
        }

        return $this->render('method_elements/processes/create.html.twig', [
            'form' => $form->createView(),
            'childAndParentProcessTypes' => $childAndParentProcessTypes
        ]);
    }

    /**
     * @Route("/method_elements/process/edit/{id?}", name="edit_process")
     * @param Request $request
     * @param DataService $dataService
     * @param $id
     * @return Response
     */
    public function editProcess(Request $request, DataService $dataService, $id)
    {
        $process = $this->entityManager->getRepository(Process::class)->find($id);
        $childAndParentProcessTypes = [];

        foreach ($dataService->getAllProcessTypes() as $kind) {
            if ($kind->getParentProcessKind())
                $childAndParentProcessTypes[$kind->getName()] = $kind->getParentProcessKind()->getName();
        }

        $form = $this->createForm(ProcessType::class, $process);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($form->getData());
            $this->entityManager->flush();
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/processes/update.html.twig', [
            'form' => $form->createView(),
            'childAndParentProcessTypes' => $childAndParentProcessTypes
        ]);
    }

    /**
     * @Route("/method_elements/role/create", name="create_role")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function createRole(Request $request, DataService $dataService): Response
    {
        $form = $this->createMultiEntityForm('roles', RoleType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()['roles'] as $role) {
                foreach ($dataService->getAllRoles() as $existingRole) {
                    if (strcasecmp($existingRole->getName(), $role->getName()) === 0) {
                        $form->addError(new FormError($role->getName() . ' already exists'));
                        return $this->render('method_elements/roles/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }

                $this->entityManager->persist($role);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/roles/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/method_elements/role/edit/{id?}", name="edit_role")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editRole(Request $request, $id)
    {
        $role = $this->entityManager->getRepository(Role::class)->find($id);
        $form = $this->createForm(RoleType::class, $role);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/roles/update.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/method_elements/artifact/create", name="create_artifact")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function createArtifact(Request $request, DataService $dataService): Response
    {
        $form = $this->createMultiEntityForm('artifacts', ArtifactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()['artifacts'] as $artifact) {
                foreach ($dataService->getAllArtifacts() as $existingArtifact) {
                    if (strcasecmp($existingArtifact->getName(), $artifact->getName()) === 0) {
                        $form->addError(new FormError($artifact->getName() . ' already exists'));
                        return $this->render('method_elements/artifacts/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }
                $this->entityManager->persist($artifact);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/artifacts/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/method_elements/artifact/edit/{id?}", name="edit_artifact")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editArtifact(Request $request, $id)
    {
        $artifact = $this->entityManager->getRepository(Artifact::class)->find($id);
        $form = $this->createForm(ArtifactType::class, $artifact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/artifacts/update.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/method_elements/process_type/create", name="create_process_type")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function createProcessKind(Request $request, DataService $dataService): Response
    {
        $form = $this->createMultiEntityForm('processKinds', ProcessKindType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()['processKinds'] as $processKind) {
                foreach ($dataService->getAllProcessTypes() as $existingProcessKind) {
                    if (strcasecmp($existingProcessKind->getName(), $processKind->getName()) === 0) {
                        $form->addError(new FormError($processKind->getName() . ' already exists'));
                        return $this->render('method_elements/process_types/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }
                $this->entityManager->persist($processKind);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/process_types/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/method_elements/process_type/edit/{id?}", name="edit_process_type")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editProcessKind(Request $request, $id)
    {
        $processType = $this->entityManager->getRepository(ProcessKind::class)->find($id);
        $form = $this->createForm(ProcessKindType::class, $processType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/process_types/update.html.twig', [
            'form' => $form->createView(),
            'processType' => $processType
        ]);
    }

    /**
     * @Route("/method_elements/situational_factor/create", name="create_situational_factor")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function createSituationalFactor(Request $request, DataService $dataService): Response
    {
        $form = $this->createMultiEntityForm('situationalFactors', SituationalFactorType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()['situationalFactors'] as $situationalFactor) {
                foreach ($dataService->getAllSituationalFactors() as $existingSituationalFactor) {
                    if (strcasecmp($existingSituationalFactor->getName(), $situationalFactor->getName()) === 0) {
                        $form->addError(new FormError($situationalFactor->getName() . ' already exists'));
                        return $this->render('method_elements/situational_factors/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }
                $this->entityManager->persist($situationalFactor);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/situational_factors/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/method_elements/situational_factor/edit/{id?}", name="edit_situational_factor")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editSituationalFactor(Request $request, $id)
    {
        $situationalFactor = $this->entityManager->getRepository(SituationalFactor::class)->find($id);
        $form = $this->createForm(SituationalFactorType::class, $situationalFactor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $situationalFactor->setVariants($situationalFactor->getVariants()->toArray());
            $this->entityManager->flush();
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/situational_factors/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/method_elements/tool/create", name="create_tool")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function createTool(Request $request, DataService $dataService): Response
    {
        $form = $this->createMultiEntityForm('tools', ToolType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()['tools'] as $tool) {
                foreach ($dataService->getAllTools() as $existingTool) {
                    if (strcasecmp($existingTool->getType(), $tool->getType()) === 0) {
                        $form->addError(new FormError($tool->getType() . ' already exists. Please add new tools inside this tool type.'));
                        return $this->render('method_elements/tools/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }
                $this->entityManager->persist($tool);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/tools/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/method_elements/tool/edit/{id?}", name="edit_tool")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editTool(Request $request, $id)
    {
        $tool = $this->entityManager->getRepository(Tool::class)->find($id);
        $form = $this->createForm(ToolType::class, $tool);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tool->setVariants($tool->getVariants()->toArray());
            $this->entityManager->flush();
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/tools/update.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/method_elements/delete/{type}/{id?}", name="delete_method_element")
     * @param Request $request
     * @param $id
     * @param $type
     * @return RedirectResponse
     */
    public function deleteMethodElement(Request $request, $id, $type)
    {
        $entityType = null;
        if ($type == 'process')
            $entityType = Process::class;
        else if ($type == 'processKind')
            $entityType = ProcessKind::class;
        else if ($type == 'role')
            $entityType = Role::class;
        else if ($type == 'artifact')
            $entityType = Artifact::class;

        $entityManager = $this->getDoctrine()->getManager();
        $entity = $entityManager->getRepository($entityType)->find($id);
        $entityManager->remove($entity);
        $entityManager->flush();

        return $this->redirectToRoute('method_elements');
    }

    public function createMultiEntityForm(string $multiEntityFormat, $formType)
    {
        return $this->createFormBuilder()
            ->add($multiEntityFormat, CollectionType::class, [
                'label' => false,
                'entry_type' => $formType,
                'entry_options' => [
                    'label' => false
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'error_bubbling' => false,
                'allow_extra_fields' => true
            ])
            ->add('Submit', SubmitType::class)
            ->getForm();
    }

}
