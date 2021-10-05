<?php

namespace App\Controller;

use App\Entity\Artifact;
use App\Entity\BmdGraph;
use App\Entity\BusinessModel;
use App\Entity\BusinessModelDefinition;
use App\Entity\BusinessSegment;
use App\Entity\MethodBuildingBlock;
use App\Entity\ProcessKind;
use App\Entity\Process;
use App\Entity\Role;
use App\Entity\SituationalFactor;
use App\Entity\Tool;
use App\Form\ArtifactType;
use App\Form\BusinessModelDefinitionType;
use App\Form\ProcessKindType;
use App\Form\ProcessType;
use App\Form\RoleType;
use App\Form\SituationalFactorType;
use App\Form\ToolType;
use App\Service\DataService;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
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
        $businessModelSegments = [];
        foreach ($dataService->getAllBusinessModelDefinitions() as $businessModelDefinition) {
            foreach ($businessModelDefinition->getSegments() as $segment) {
                $customSegment = new stdClass();
                $customSegment->type = $businessModelDefinition->getType();
                $customSegment->name = $segment;
                $customSegment->id = $businessModelDefinition->getId();
                $businessModelSegments[] = $customSegment;
            }
        }


        return $this->render('method_elements/index.html.twig', [
            'artifacts' => $dataService->getAllArtifacts(),
            'processes' => $dataService->getAllProcesses(),
            'processTypes' => $dataService->getAllProcessTypes(),
            'roles' => $dataService->getAllRoles(),
            'situationalFactors' => $dataService->getAllSituationalFactors(),
            'tools' => $dataService->getAllTools(),
            'businessModelSegments' => $businessModelSegments
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
        if (empty($dataService->getAllProcessTypes())) {
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
     * @Route("/method_elements/process/view/{name?}", name="view_process")
     * @param string $name
     * @return Response
     */
    public function viewProcess(string $name)
    {
        $process = $this->getDoctrine()->getRepository(Process::class)->findOneBy(['name' => $name]);
        $form = $this->createForm(ProcessType::class, $process);

        return $this->render('method_elements/processes/view.html.twig', [
            'process' => $process,
            'form' => $form->createView()
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
     * @Route("/method_elements/role/view/{name?}", name="view_role")
     * @param string $name
     * @return Response
     */
    public function viewRole(string $name)
    {
        $role = $this->getDoctrine()->getRepository(Role::class)->findOneBy(['name' => $name]);
        $form = $this->createForm(RoleType::class, $role);

        return $this->render('method_elements/roles/view.html.twig', [
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
     * @Route("/method_elements/artifact/view/{name?}", name="view_artifact")
     * @param string $name
     * @return Response
     */
    public function viewArtifact(string $name)
    {
        $artifact = $this->getDoctrine()->getRepository(Artifact::class)->findOneBy(['name' => $name]);
        $form = $this->createForm(ArtifactType::class, $artifact);

        return $this->render('method_elements/artifacts/view.html.twig', [
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
     * @Route("/method_elements/process_type/view/{name?}", name="view_process_type")
     * @param string $name
     * @return Response
     */
    public function viewProcessKind(string $name)
    {
        $processType = $this->getDoctrine()->getRepository(ProcessKind::class)->findOneBy(['name' => $name]);
        $form = $this->createForm(ProcessKindType::class, $processType);

        return $this->render('method_elements/process_types/view.html.twig', [
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
        $originalSituationalFactorName = $situationalFactor->getName();

        /** @var array $originalVariants * */
        $originalVariants = is_array($situationalFactor->getVariants()) ? $situationalFactor->getVariants() :
            $situationalFactor->getVariants()->toArray();

        $form = $this->createForm(SituationalFactorType::class, $situationalFactor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var array $variants * */
            $variants = !is_array($situationalFactor->getVariants()) ?
                $situationalFactor->getVariants()->toArray() : $situationalFactor->getVariants();

            $removedVariants = [];
            foreach ($originalVariants as $originalVariant) {
                if (!in_array($originalVariant, $variants))
                    $removedVariants[] = $originalVariant;
            }

            $addedVariants = [];
            foreach ($variants as $newVariant) {
                if (!in_array($newVariant, $originalVariants))
                    $addedVariants[] = $newVariant;
            }


            $methodBlocks = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->findAll();
            $graphs = $this->getDoctrine()->getRepository(BmdGraph::class)->findAll();

            if ($originalSituationalFactorName !== $situationalFactor->getName()) {
                $this->updateSituationalFactor($methodBlocks, $situationalFactor, $originalSituationalFactorName);
                $this->updateSituationalFactor($graphs, $situationalFactor, $originalSituationalFactorName);
            }
            if (sizeof($removedVariants) > 0) {
                $this->updateSituationalFactor($methodBlocks, $situationalFactor, $originalSituationalFactorName, $removedVariants, $addedVariants);
                $this->updateSituationalFactor($graphs, $situationalFactor, $originalSituationalFactorName, $removedVariants, $addedVariants);
            }

            $situationalFactor->setVariants($variants);
            $this->entityManager->flush();
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/situational_factors/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function updateSituationalFactor($components, $newSituationalFactor, $oldSituationalFactor = null, $removedVariants = null, $addedVariants = null)
    {
        $needToAddNewVariants = false;

        foreach ($components as $component) {
            $componentSituationalFactors = $component->getSituationalFactors();
            foreach ($componentSituationalFactors as $key => $componentSituationalFactor) {
                $componentSituationalFactor = explode(":", $componentSituationalFactor);

                if (!$removedVariants && $oldSituationalFactor == trim($componentSituationalFactor[0])) {
                    $variant = trim($componentSituationalFactor[1]);
                    $newSituationalFactorOfComponent = $newSituationalFactor->getName() . " : " . $variant;
                    unset($componentSituationalFactors[$key]);
                    $componentSituationalFactors[] = $newSituationalFactorOfComponent;
                } else if ($removedVariants && in_array(trim($componentSituationalFactor[1]), $removedVariants)) {
                    $needToAddNewVariants = true;
                    unset($componentSituationalFactors[$key]);
                }
            }

            if ($needToAddNewVariants) {
                foreach ($addedVariants as $newVariant) {
                    $componentSituationalFactors [] = $newSituationalFactor->getName() . " : " . $newVariant;
                }

            }
            $needToAddNewVariants = false;
            $component->setSituationalFactors($componentSituationalFactors);
        }
    }

    /**
     * @Route("/method_elements/situational_factor/view/{name?}", name="view_situational_factor")
     * @param string $name
     * @return Response
     */
    public function viewSituationalFactor(string $name)
    {
        $name = trim(explode(":", $name)[0]);
        $factor = $this->getDoctrine()->getRepository(SituationalFactor::class)->findOneBy(['name' => $name]);
        $form = $this->createForm(SituationalFactorType::class, $factor);

        return $this->render('method_elements/situational_factors/view.html.twig', [
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
     * @Route("/method_elements/business_model_segment/create", name="create_business_model_segment")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function createBusinessModelSegment(Request $request, DataService $dataService): Response
    {
        $form = $this->createMultiEntityForm('businessModelSegments', BusinessModelDefinitionType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($form->getData()['businessModelSegments'] as $businessModelDefinition) {
                foreach ($dataService->getAllBusinessModelDefinitions() as $existingBusinessModelDefinition) {
                    if (strcasecmp($existingBusinessModelDefinition->getType(), $businessModelDefinition->getType()) === 0) {
                        $form->addError(new FormError($businessModelDefinition->getType() . ' already exists'));
                        return $this->render('method_elements/business_model_segments/create.html.twig', [
                            'form' => $form->createView()
                        ]);
                    }
                }
                $this->entityManager->persist($businessModelDefinition);
                $this->entityManager->flush();
            }
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/business_model_segments/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/method_elements/business_model_segment/edit/{id?}", name="edit_business_model_segment")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function editBusinessModelSegment(Request $request, $id)
    {
        $businessModelDefinition = $this->entityManager->getRepository(BusinessModelDefinition::class)->find($id);
        $form = $this->createForm(BusinessModelDefinitionType::class, $businessModelDefinition);

        $originalSegments = $businessModelDefinition->getSegments()->toArray();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**@var BusinessModel $affectedBusinessModel * */
            $affectedBusinessModel = $this->entityManager->getRepository(BusinessModel::class)->findOneBy(['type' => $businessModelDefinition->getType()]);

            /* Check if any segment has been remove from the definition. If yes then remove it from the respective
            business model also */
            if ((sizeof($originalSegments) > sizeof($businessModelDefinition->getSegments()->toArray())) && $affectedBusinessModel) {
                $removedSegments = array_diff($originalSegments, $businessModelDefinition->getSegments()->toArray());

                foreach ($removedSegments as $removedSegment) {
                    foreach ($affectedBusinessModel->getSegments() as $segmentEntity) {
                        if ($segmentEntity->getName() === $removedSegment) {
                            $affectedBusinessModel->removeSegment($segmentEntity);
                            $this->entityManager->remove($segmentEntity);
                        }
                    }
                    /* Also remove the business segments from any related method blocks */
                    foreach ($this->entityManager->getRepository(MethodBuildingBlock::class)->findAll() as $methodBuildingBlock) {
                        $businessModelSegments = $methodBuildingBlock->getBusinessModelSegments();
                        foreach ($businessModelSegments as $key => $businessModelSegment) {
                            $explodedSegment = explode(":", $businessModelSegment);
                            if ($affectedBusinessModel->getType() === trim($explodedSegment[0]) && $removedSegment === trim($explodedSegment[1]))
                                unset($businessModelSegments[$key]);
                        }
                        $methodBuildingBlock->setBusinessModelSegments($businessModelSegments);
                    }
                }
                $this->entityManager->persist($affectedBusinessModel);
            }
            /* Check if a new segment has been added to the definition. If yes then add it to the respective
            business model also */
            if ((sizeof($originalSegments) < sizeof($businessModelDefinition->getSegments()->toArray())) && $affectedBusinessModel) {
                $newSegments = array_diff($businessModelDefinition->getSegments()->toArray(), $originalSegments);

                foreach ($newSegments as $newSegment) {
                    $segmentEntity = new BusinessSegment();
                    $segmentEntity->setName($newSegment);
                    $affectedBusinessModel->addSegment($segmentEntity);
                }
                $this->entityManager->persist($affectedBusinessModel);
            }
            $businessModelDefinition->setSegments($businessModelDefinition->getSegments()->toArray());
            $this->entityManager->flush();
            return $this->redirectToRoute("method_elements");
        }

        return $this->render('method_elements/business_model_segments/update.html.twig', [
            'definition' => $businessModelDefinition,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/method_elements/business_model_segment/view/{name?}", name="view_business_model_segment")
     * @param string $name
     * @return Response
     */
    public function viewBusinessModelSegment(string $name)
    {
        $name = trim(explode(":", $name)[0]);
        $definition = $this->getDoctrine()->getRepository(BusinessModelDefinition::class)->findOneBy(['type' => $name]);
        $form = $this->createForm(BusinessModelDefinitionType::class, $definition);

        return $this->render('method_elements/business_model_segments/view.html.twig', [
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
        else if ($type == 'tool')
            $entityType = Tool::class;
        else if ($type == 'factor')
            $entityType = SituationalFactor::class;
        else if ($type == 'artifact')
            $entityType = Artifact::class;
        else if ($type == 'definition') {
            $entityType = BusinessModelDefinition::class;
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entity = $entityManager->getRepository($entityType)->find($id);
        if ($type == 'definition') {
            $businessModelToDelete = $entityManager->getRepository(BusinessModel::class)->findOneBy(['type' => $entity->getType()]);
            $entityManager->remove($businessModelToDelete);
        }
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
