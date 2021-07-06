<?php

namespace App\Controller;

use App\Entity\SituationalMethod;
use App\Service\DataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MethodEnactmentController extends AbstractController{

    /**
     * @Route("/enactments", name="enactments")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function enactments(Request $request, DataService $dataService): Response
    {
        return $this->render("situational_method/enactments.html.twig", [
            'situationalMethods' => $dataService->getAllSituationalMethods()
        ]);
    }

    /**
     * @Route("/enactment/{id}", name="enactment")
     * @param Request $request
     * @param DataService $dataService
     * @param int $id
     * @return Response
     */
    public function enactment(Request $request, DataService $dataService, int $id): Response
    {
        $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)->find($id);

        $tools = [];
        $roles = [];
        foreach ($dataService->getAllTools() as $tool)
            $tools [$tool->getType()] = $tool->getImplodedVariants();
        foreach ($dataService->getAllRoles() as $role)
            $roles [] = $role->getName();

        return $this->render("situational_method/enactment.html.twig", [
            'situationalMethod' => $situationalMethod,
            'situationalFactors' => $dataService->getAllSituationalFactors(),
            'graphsAndTheirSituationalFactors'=> $situationalMethod->getGraphsAndTheirSituationalFactors(),
            'tools' => $tools,
            'roles' => $roles,
        ]);
    }


}