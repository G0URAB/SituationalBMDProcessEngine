<?php

namespace App\Controller;

use App\Entity\BusinessModel;
use App\Entity\BusinessSegment;
use App\Entity\MethodBuildingBlock;
use App\Entity\SituationalMethod;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
                    ->findOneBy(['platformOwner'=>$situationalMethod->getPlatformOwner(), 'type'=>$situationalMethod->getBusinessModelType()]);

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
}
