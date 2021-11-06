<?php

namespace App\Controller;

use App\Entity\BusinessModel;
use App\Entity\BusinessComponent;
use App\Entity\BusinessText;
use App\Entity\MethodBuildingBlock;
use App\Entity\SituationalMethod;
use App\Form\BusinessModelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BusinessModelController extends AbstractController
{
    /**
     * @Route("/business/model/ajax", name="business_model_ajax")
     * @param Request $request
     * @return Response
     */
    public function businessModelAjax(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            if ($request->get("request_type") == "get_components") {
                $businessModelComponents = [];

                /**@var MethodBuildingBlock * */
                $methodBlock = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)
                    ->findOneBy(["id" => $request->get("method_block_id")]);

                /**@var SituationalMethod * */
                $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)
                    ->findOneBy(["id" => $request->get("situational_method_id")]);

                foreach ($methodBlock->getBusinessModelComponents() as $component) {
                    $explodedBusinessModelComponent = explode(":", $component);
                    if (trim($explodedBusinessModelComponent[0]) == $situationalMethod->getBusinessModelType()) {
                        $componentName = trim($explodedBusinessModelComponent[1]);
                        $businessComponent = $this->getDoctrine()->getRepository(BusinessComponent::class)->findOneBy(['name' => $componentName]);
                        $businessModelComponents[] = ['name' => $componentName, 'value' => $businessComponent->getValues()];
                    }
                }
                return new JsonResponse(['components' => $businessModelComponents]);
            }
            if ($request->get("request_type") == "update_components") {
                $entityManager = $this->getDoctrine()->getManager();
                $componentsData = $request->get("components_data");

                /**@var SituationalMethod * */
                $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)
                    ->findOneBy(["id" => $request->get("situational_method_id")]);

                /**@var BusinessModel * */
                $businessModel = $entityManager->getRepository(BusinessModel::class)
                    ->findOneBy(['type' => $situationalMethod->getBusinessModelType()]);

                foreach ($businessModel->getComponents() as $component) {
                    /* If the component exists in the submitted data */
                    if (in_array($component->getName(), array_column($componentsData, "name"))) {
                        $component->setValues(array_column($componentsData, "value", "name")[$component->getName()]);
                        $component->setLog($request->get("log"));
                    }
                }
                $entityManager->flush();
                return new JsonResponse(['status' => 'success', 'msg' => 'Business Components Updated!!']);
            }
        }

        return new Response("Invalid Request", 300);
    }

    /**
     * @Route("/business/model/show/{methodId?}", name="show_business_model")
     * @param Request $request
     * @param string $methodId
     * @return Response
     */
    public function viewOrModifyBusinessModel(Request $request, string $methodId = null): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $situationalMethod = null;

        if ($methodId) {
            $situationalMethod = $entityManager->getRepository(SituationalMethod::class)->find($methodId);
        }

        $allBusinessModels = $entityManager->getRepository(BusinessModel::class)->findAll();
        $allBusinessModelTypes = [];
        $preferredBusinessModelType = null;

        /* Fill up allBusinessModelTypes to create a choice form */
        foreach ($allBusinessModels as $key => $businessModel) {
            if ($key === array_key_first($allBusinessModels))
                $preferredBusinessModelType = $businessModel->getType();
            $allBusinessModelTypes[$businessModel->getType()] = $businessModel->getType();
        }

        /*$allBusinessModelTypes["A dummy choice"]="A dummy choice";*/

        $preferredBusinessModelType = $methodId ? $situationalMethod->getBusinessModelType() : $preferredBusinessModelType;

        /* A form to check if the user wants to see data from other type of business model */
        $businessModelChoiceForm = $this->createFormBuilder()
            ->add("businessModelChoices", ChoiceType::class, [
                'label' => "Select a business model type",
                'choices' => $allBusinessModelTypes,
                'preferred_choices' => [$preferredBusinessModelType]
            ])->getForm();
        $businessModelChoiceForm->handleRequest($request);

        if ($businessModelChoiceForm->isSubmitted()) {
            $preferredBusinessModelType = $businessModelChoiceForm->getData()["businessModelChoices"];
        }

        /**@var BusinessModel $businessModel * */
        $businessModel = $entityManager->getRepository(BusinessModel::class)
            ->findOneBy(['type' => $preferredBusinessModelType]);

        $businessModelForm = $this->createForm(BusinessModelType::class, $businessModel);
        $businessModelForm->handleRequest($request);

        if ($businessModelForm->isSubmitted() && $businessModelForm->isValid()) {
            /* Add a log that if the components are going to be updated by a super admin or any platform owner */
            if ($this->isGranted('ROLE_SUPER_ADMIN') || $this->isGranted('ROLE_PLATFORM_OWNER')) {
                $date = date_create("today");
                foreach ($businessModel->getComponents() as $component)
                    $component->setLog("Modified directly by " . $this->getUser()->getEmployeeName() . " on " . date_format($date, "d.m.Y"));
            }

            $entityManager->persist($businessModel);

            $businessTexts = $entityManager->getRepository(BusinessText::class)->findAll();
            foreach ($businessTexts as $businessText) {
                if (!$businessText->getBusinessComponent()) {
                    $entityManager->remove($businessText);
                }
            }
            $entityManager->flush();

            $this->addFlash("success", "Business Model was updated");
            return $this->redirectToRoute("show_business_model", ['methodId' => $methodId]);
        }

        return $this->render("business_model/index.html.twig", [
            'preferred_business_model_type' => $preferredBusinessModelType,
            'business_model_choice_form' => $businessModelChoiceForm->createView(),
            'business_model_form' => $businessModelForm->createView()
        ]);
    }

    /**
     * @Route("/update/business_model_components/{methodId}/{taskId}/{blockId}", name="update_business_model_components")
     * @param Request $request
     * @param int $methodId
     * @param int $taskId
     * @param int $blockId
     * @param SessionInterface $session
     * @return Response
     */
    public function updateBusinessModelComponents(Request $request, int $methodId, int $taskId, int $blockId, SessionInterface $session)
    {
        $entityManager = $this->getDoctrine()->getManager();

        /**@var SituationalMethod $situationalMethod * */
        $situationalMethod = $entityManager->getRepository(SituationalMethod::class)->find($methodId);

        $defaultModelType = $situationalMethod->getBusinessModelType();

        /**@var MethodBuildingBlock $methodBuildingBlock * */
        $methodBuildingBlock = $entityManager->getRepository(MethodBuildingBlock::class)->find($blockId);

        /**@var BusinessModel $businessModel * */
        $businessModel = $entityManager->getRepository(BusinessModel::class)
            ->findOneBy(['type' => $defaultModelType]);

        $businessComponents = [];

        foreach ($methodBuildingBlock->getBusinessModelComponents() as $component) {
            $explodedComponent = explode(":", $component);
            $businessModelTypeOfComponent = trim($explodedComponent[0]);
            $componentName = trim($explodedComponent[1]);

            if ($defaultModelType == $businessModelTypeOfComponent) {
                $businessComponent = $this->getDoctrine()->getRepository(BusinessComponent::class)->findBy([
                    'name' => $componentName, 'businessModel' => $businessModel
                ])[0];
                $businessComponents[] = $businessComponent;
            }
        }

        $temporaryBusinessModel = new BusinessModel();
        foreach ($businessComponents as $component)
            $temporaryBusinessModel->addComponent($component);
        $form = $this->createForm(BusinessModelType::class, $temporaryBusinessModel);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $components = $temporaryBusinessModel->getComponents();
            foreach ($components as $component)
            {
                $component->setBusinessModel($businessModel);
                $entityManager->persist($component);
            }

            $entityManager->flush();

            $session->set('id_of_completed_task', $taskId);

            return $this->redirectToRoute('enactment',['id'=>$situationalMethod->getId()]);
        }

        return $this->render("situational_method/update_business_components.html.twig", [
            'business_model_form' => $form->createView(),
            'preferred_business_model_type' => $defaultModelType,
            'methodBlock' => $methodBuildingBlock,
            'situationalMethod' => $situationalMethod
        ]);
    }
}
