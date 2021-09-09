<?php

namespace App\Controller;

use App\Entity\BusinessModel;
use App\Entity\BusinessSegment;
use App\Entity\MethodBuildingBlock;
use App\Entity\SituationalMethod;
use App\Entity\User;
use App\Form\BusinessModelType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        if($request->isXmlHttpRequest())
        {
            if($request->get("request_type")=="get_segments")
            {
                $businessModelSegments = [];

                /**@var MethodBuildingBlock **/
                $methodBlock = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)
                    ->findOneBy(["id"=>$request->get("method_block_id")]);

                /**@var SituationalMethod **/
                $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)
                    ->findOneBy(["id"=>$request->get("situational_method_id")]);

                foreach($methodBlock->getBusinessModelSegments() as $segment)
                {
                    $explodedBusinessModelSegment = explode(":",$segment);
                    if(trim($explodedBusinessModelSegment[0]) == $situationalMethod->getBusinessModelType())
                    {
                        $businessModelSegments[] = trim($explodedBusinessModelSegment[1]);
                    }
                }
                return new JsonResponse(['segments'=>$businessModelSegments]);
            }
            if($request->get("request_type")=="update_segments")
            {
                $entityManager = $this->getDoctrine()->getManager();
                $segmentsData = $request->get("segments_data");

                /**@var SituationalMethod **/
                $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)
                    ->findOneBy(["id"=>$request->get("situational_method_id")]);

                /**@var BusinessModel **/
                $businessModel = $entityManager->getRepository(BusinessModel::class)
                    ->findOneBy(['type'=>$situationalMethod->getBusinessModelType()]);

                foreach ($businessModel->getSegments() as $segment)
                {
                    $segment->setValues(array_column($segmentsData,"value","name")[$segment->getName()]);
                    $segment->setLog($request->get("log"));
                }
                $entityManager->flush();
                return new JsonResponse(['status'=>'success','msg'=>'Business Segments Updated!!']);
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
    public function viewOrModifyBusinessModel(Request $request, string $methodId=null): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $situationalMethod = null;

        if($methodId)
        {
            $situationalMethod = $entityManager->getRepository(SituationalMethod::class)->find($methodId);
        }

        $allBusinessModels = $entityManager->getRepository(BusinessModel::class)->findAll();
        $allBusinessModelTypes = [];
        $preferredBusinessModelType = null;

        /* Fill up allBusinessModelTypes to create a choice form */
        foreach ($allBusinessModels as $key=>$businessModel)
        {
            if($key===array_key_first($allBusinessModels))
                $preferredBusinessModelType = $businessModel->getType();
            $allBusinessModelTypes[$businessModel->getType()]= $businessModel->getType();
        }

        $allBusinessModelTypes["A dummy choice"]="A dummy choice";

        $preferredBusinessModelType = $methodId ? $situationalMethod->getBusinessModelType(): $preferredBusinessModelType;

        /* A form to check if the user wants to see data from other type of business model */
        $businessModelChoiceForm = $this->createFormBuilder()
            ->add("businessModelChoices",ChoiceType::class,[
                'label'=>"Select a business model type",
                'choices' => $allBusinessModelTypes
            ])->getForm();
        $businessModelChoiceForm->handleRequest($request);

        if($businessModelChoiceForm->isSubmitted())
        {
            $preferredBusinessModelType = $businessModelChoiceForm->getData()["businessModelChoices"];
        }

        /**@var BusinessModel **/
        $businessModel = $entityManager->getRepository(BusinessModel::class)
            ->findOneBy(['type'=>$preferredBusinessModelType]);

        $businessModelForm = $this->createForm(BusinessModelType::class, $businessModel);
        $businessModelForm->handleRequest($request);

        if($businessModelForm->isSubmitted() && $businessModelForm->isValid())
        {
            /* Add a log that if the segments are going to be updated by a super admin or any platform owner */
            if($this->isGranted('ROLE_SUPER_ADMIN') || $this->isGranted('ROLE_PLATFORM_OWNER'))
            {
                $date=date_create("today");
                foreach ($businessModel->getSegments() as $segment)
                    $segment->setLog("Modified directly by ".$this->getUser()->getEmployeeName(). " on ". date_format($date,"d.m.Y"));
            }

            $entityManager->persist($businessModel);
            $entityManager->flush();

            $this->addFlash("success", "Business Model was updated");
            return $this->redirectToRoute("show_business_model");
        }

        return $this->render("business_model/index.html.twig",[
            'preferred_business_model_type' => $preferredBusinessModelType,
            'business_model_choice_form' => $businessModelChoiceForm->createView(),
            'business_model_form' => $businessModelForm->createView()
        ]);
    }
}
