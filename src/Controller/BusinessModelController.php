<?php

namespace App\Controller;

use App\Entity\BusinessModel;
use App\Entity\BusinessSegment;
use App\Entity\BusinessText;
use App\Entity\MethodBuildingBlock;
use App\Entity\SituationalMethod;
use App\Entity\User;
use App\Form\BusinessModelType;
use App\Form\BusinessSegmentType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            if ($request->get("request_type") == "get_segments") {
                $businessModelSegments = [];

                /**@var MethodBuildingBlock * */
                $methodBlock = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)
                    ->findOneBy(["id" => $request->get("method_block_id")]);

                /**@var SituationalMethod * */
                $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)
                    ->findOneBy(["id" => $request->get("situational_method_id")]);

                foreach ($methodBlock->getBusinessModelSegments() as $segment) {
                    $explodedBusinessModelSegment = explode(":", $segment);
                    if (trim($explodedBusinessModelSegment[0]) == $situationalMethod->getBusinessModelType()) {
                        $segmentName = trim($explodedBusinessModelSegment[1]);
                        $businessSegment = $this->getDoctrine()->getRepository(BusinessSegment::class)->findOneBy(['name' => $segmentName]);
                        $businessModelSegments[] = ['name' => $segmentName, 'value' => $businessSegment->getValues()];
                    }
                }
                return new JsonResponse(['segments' => $businessModelSegments]);
            }
            if ($request->get("request_type") == "update_segments") {
                $entityManager = $this->getDoctrine()->getManager();
                $segmentsData = $request->get("segments_data");

                /**@var SituationalMethod * */
                $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)
                    ->findOneBy(["id" => $request->get("situational_method_id")]);

                /**@var BusinessModel * */
                $businessModel = $entityManager->getRepository(BusinessModel::class)
                    ->findOneBy(['type' => $situationalMethod->getBusinessModelType()]);

                foreach ($businessModel->getSegments() as $segment) {
                    /* If the segment exists in the submitted data */
                    if (in_array($segment->getName(), array_column($segmentsData, "name"))) {
                        $segment->setValues(array_column($segmentsData, "value", "name")[$segment->getName()]);
                        $segment->setLog($request->get("log"));
                    }
                }
                $entityManager->flush();
                return new JsonResponse(['status' => 'success', 'msg' => 'Business Segments Updated!!']);
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
            /* Add a log that if the segments are going to be updated by a super admin or any platform owner */
            if ($this->isGranted('ROLE_SUPER_ADMIN') || $this->isGranted('ROLE_PLATFORM_OWNER')) {
                $date = date_create("today");
                foreach ($businessModel->getSegments() as $segment)
                    $segment->setLog("Modified directly by " . $this->getUser()->getEmployeeName() . " on " . date_format($date, "d.m.Y"));
            }

            $entityManager->persist($businessModel);

            $businessTexts = $entityManager->getRepository(BusinessText::class)->findAll();
            foreach ($businessTexts as $businessText) {
                if (!$businessText->getBusinessSegment()) {
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
     * @Route("/update/business_model_segments/{methodId}/{taskId}/{blockId}", name="update_business_model_segments")
     * @param Request $request
     * @param int $methodId
     * @param int $taskId
     * @param int $blockId
     * @param SessionInterface $session
     * @return Response
     */
    public function updateBusinessModelSegments(Request $request, int $methodId, int $taskId, int $blockId, SessionInterface $session)
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

        $businessSegments = [];

        foreach ($methodBuildingBlock->getBusinessModelSegments() as $segment) {
            $explodedSegment = explode(":", $segment);
            $businessModelTypeOfSegment = trim($explodedSegment[0]);
            $segmentName = trim($explodedSegment[1]);

            if ($defaultModelType == $businessModelTypeOfSegment) {
                $businessSegment = $this->getDoctrine()->getRepository(BusinessSegment::class)->findBy([
                    'name' => $segmentName, 'businessModel' => $businessModel
                ])[0];
                $businessSegments[] = $businessSegment;
            }
        }

        $temporaryBusinessModel = new BusinessModel();
        foreach ($businessSegments as $segment)
            $temporaryBusinessModel->addSegment($segment);
        $form = $this->createForm(BusinessModelType::class, $temporaryBusinessModel);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $segments = $temporaryBusinessModel->getSegments();
            foreach ($segments as $segment)
            {
                $segment->setBusinessModel($businessModel);
                $entityManager->persist($segment);
            }

            $entityManager->flush();

            $session->set('id_of_completed_task', $taskId);

            return $this->redirectToRoute('enactment',['id'=>$situationalMethod->getId()]);
        }

        return $this->render("situational_method/update_business_segments.html.twig", [
            'business_model_form' => $form->createView(),
            'preferred_business_model_type' => $defaultModelType,
            'methodBlock' => $methodBuildingBlock,
            'situationalMethod' => $situationalMethod
        ]);
    }
}
