<?php

namespace App\Controller;

use App\Entity\BmdGraph;
use App\Entity\CancelledMethodBlock;
use App\Entity\MethodBuildingBlock;
use App\Entity\Process;
use App\Entity\ProcessKind;
use App\Entity\SituationalMethod;
use App\Service\DataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MethodConstructionController extends AbstractController
{

    /**
     * @Route("/situational_methods", name="situational_methods")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function situationalMethods(Request $request, DataService $dataService): Response
    {
        return $this->render("situational_method/methods.html.twig", [
            'situationalMethods' => $dataService->getAllSituationalMethods()
        ]);
    }

    /**
     * @Route("/situational_method/create", name="construct_situational_method")
     * @param Request $request
     * @param DataService $dataService
     * @return Response
     */
    public function constructSituationalMethod(Request $request, DataService $dataService): Response
    {
        if (!$request->isXmlHttpRequest()) {

            $situationalFactors = $dataService->getAllSituationalFactors();

            $tools = [];
            $roles = [];
            foreach ($dataService->getAllTools() as $tool)
                $tools [$tool->getType()] = $tool->getImplodedVariants();
            foreach ($dataService->getAllRoles() as $role)
                $roles [] = $role->getName();

            return $this->render('situational_method/construct.html.twig', [
                'situationalFactors' => $situationalFactors,
                'tools' => $tools,
                'roles' => $roles,
            ]);
        }

        if ($request->get("request_type") == "get_graphs") {
            $matchingGraphs = [];
            if ($request->get('situationalFactors')) {
                $queriedFactors = $request->get("situationalFactors");
                $countOfQueriedFactors = count($queriedFactors);
                $totalGraphs = $this->getDoctrine()->getRepository(BmdGraph::class)->findAll();
                foreach ($totalGraphs as $graph) {

                    $countFound = 0;
                    foreach ($graph->getSituationalFactors() as $factor) {

                        if (in_array($factor, $queriedFactors)) {
                            $countFound++;
                        }
                    }
                    if ($countOfQueriedFactors == $countFound) {
                        $matchingGraphs[] = $dataService->getBMDGraphObject($graph);
                    }

                }
            }
            return new JsonResponse(['status' => "ok", 'graphs' => $matchingGraphs]);
        }

        if ($request->get("request_type") == "get_method_blocks") {

            /**
             * @var BmdGraph $bmdGraph
             */
            $bmdGraph = $this->getDoctrine()->getRepository(BmdGraph::class)->findOneBy([
                'name' => $request->get("root_graph_name")
            ]);

            $processType = $this->getDoctrine()->getRepository(ProcessKind::class)->findOneBy([
                'name' => $request->get("process_type")
            ]);

            $situationSpecificMethodBuildingBlocks = [];
            $situationSpecificBMDGraphs = [];

            foreach ($processType->getProcesses() as $process) {

                /**
                 * @var MethodBuildingBlock $methodBlock
                 */
                $methodBlock = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->findOneBy([
                    'process' => $process
                ]);

                if ($dataService->checkIfMethodBlockIsSituationSpecific($methodBlock, $bmdGraph)) {
                    if ($methodBlock)
                        $situationSpecificMethodBuildingBlocks[] = $dataService->getMethodBlockObject($methodBlock);
                }

            }

            //Also check which other processes can also be used in this process type
            $allProcesses = $this->getDoctrine()->getRepository(Process::class)->findAll();
            foreach ($allProcesses as $process) {
                if (in_array($processType, $process->getOtherRelatedProcessKinds())) {
                    $methodBlock = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->findOneBy([
                        'process' => $process
                    ]);

                    if ($dataService->checkIfMethodBlockIsSituationSpecific($methodBlock, $bmdGraph))
                        $situationSpecificMethodBuildingBlocks[] = $dataService->getMethodBlockObject($methodBlock);
                }
            }

            $graphsWithParentProcessType = $this->getDoctrine()->getRepository(BmdGraph::class)->findBy([
                'parentProcessKind' => $processType
            ]);
            if ($graphsWithParentProcessType) {
                foreach ($graphsWithParentProcessType as $probableSituationSpecificGraph) {
                    if ($dataService->checkIfMethodBlockIsSituationSpecific($probableSituationSpecificGraph, $bmdGraph)
                        && $probableSituationSpecificGraph->getId() !== $bmdGraph->getId()
                        && $request->get("calling_graph_name") != $probableSituationSpecificGraph->getName())

                        $situationSpecificBMDGraphs[] = $dataService->getBMDGraphObject($probableSituationSpecificGraph);
                }
            }

            return new JsonResponse(['blocks' => $situationSpecificMethodBuildingBlocks, 'graphs' => $situationSpecificBMDGraphs]);
        }

        return new Response("Invalid request", 400);
    }


    /**
     * @Route("/handle/situational_method/request", name="handle_situational_method_request")
     * @param Request $request
     * @param DataService $dataService
     * @return JsonResponse|Response
     */
    public function handleSituationalMethodRequest(Request $request, DataService $dataService)
    {
        if ($request->isXmlHttpRequest()) {

            $nodes = $request->get("nodes");
            $edges = $request->get("edges");
            $tasks = $request->get("tasks");
            $nameOfSituationalMethod = $request->get("name_of_situational_method");
            $nameOfPlatformOwner = $request->get("platform_owner_name");
            $phoneOfPlatformOwner = $request->get("platform_owner_phone");
            $addressOfPlatformOwner = $request->get("platform_owner_address");
            $emailOfPlatformOwner = $request->get("platform_owner_email");
            $bmdGraphsBeingUsed = $request->get("bmd_graphs_being_used");
            $graphsAndTheirSituationalFactors = $request->get("graphs_and_their_factors");

            $entityManager = $this->getDoctrine()->getManager();

            $allRoles = [];
            foreach ($dataService->getAllRoles() as $role)
                array_push($allRoles, $role->getName());

            $allToolTypes = [];
            foreach ($dataService->getAllTools() as $tool)
                array_push($allToolTypes, $tool->getType());

            $situationalMethod = null;

            if ($request->get("type") == "new_situational_method") {
                $situationalMethod = new SituationalMethod();
            } else {
                $situationalMethod = $entityManager->getRepository(SituationalMethod::class)->find($request->get("id"));
                $cancelledBlocks = $request->get("cancelledBlocks") ? $request->get("cancelledBlocks") : null;

                if(!empty($cancelledBlocks))
                {
                    foreach ($cancelledBlocks as $cancelledBlock)
                    {
                        $cancelledMethodBlock = new CancelledMethodBlock();
                        $cancelledMethodBlock->setName($cancelledBlock['label']);
                        $cancelledMethodBlock->setReason($cancelledBlock['removalReason']);
                        $cancelledMethodBlock->setJsonData(json_encode($cancelledBlock));
                        $cancelledMethodBlock->setDateTime(new \DateTime("now"));
                        $situationalMethod->addCancelledMethodBlock($cancelledMethodBlock);
                        $entityManager->persist($cancelledMethodBlock);
                    }
                }
            }

            $situationalMethod->setName($nameOfSituationalMethod);
            $situationalMethod->setPlatformOwnerName($nameOfPlatformOwner);
            $situationalMethod->setPlatformOwnerPhone($phoneOfPlatformOwner);
            $situationalMethod->setPlatformOwnerAddress($addressOfPlatformOwner);
            $situationalMethod->setPlatformOwnerEmail($emailOfPlatformOwner);
            $situationalMethod->setBmdGraphsBeingUsed($bmdGraphsBeingUsed);
            $situationalMethod->setJsonNodes(json_encode($nodes));
            $situationalMethod->setJsonEdges(json_encode($edges));
            $situationalMethod->setGraphsAndTheirSituationalFactors(json_encode($graphsAndTheirSituationalFactors));


            if ($request->get("type") == "new_situational_method") {
                $entityManager->persist($situationalMethod);
            }

            $situationalMethod->setJsonTasks(json_encode($tasks));
            $entityManager->flush();

            return new JsonResponse(['status' => "okay", "msg" => "Situational Method Saved!!"]);
        }

        return new Response("Invalid Request", 400);
    }


    /**
     * @Route("/situational_method/modify/{id}", name="modify_situational_method")
     * @param Request $request
     * @param DataService $dataService
     * @param int $id
     * @return Response
     */
    public function modifySituationalMethod(Request $request, DataService $dataService, int $id): Response
    {
        $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();

        if($request->isXmlHttpRequest() && $request->get("set_enactment"))
        {
            $enactment = $request->get("set_enactment")=="true";
            $situationalMethod->setEnacted($enactment);
            $entityManager->flush();
        }

        $tools = [];
        $roles = [];
        foreach ($dataService->getAllTools() as $tool)
            $tools [$tool->getType()] = $tool->getImplodedVariants();
        foreach ($dataService->getAllRoles() as $role)
            $roles [] = $role->getName();

        return $this->render("situational_method/modify.html.twig", [
            'situationalMethod' => $situationalMethod,
            'situationalFactors' => $dataService->getAllSituationalFactors(),
            'graphsAndTheirSituationalFactors'=> $situationalMethod->getGraphsAndTheirSituationalFactors(),
            'tools' => $tools,
            'roles' => $roles,
        ]);
    }

    /**
     * @Route("/situational_method/show/{id}", name="show_situational_method")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function showSituationalMethod(Request $request, int $id): Response
    {
        $situationalMethod = $this->getDoctrine()->getRepository(SituationalMethod::class)->find($id);

        return $this->render("situational_method/show.html.twig", [
            'situationalMethod' => $situationalMethod,
            'graphsAndSituationalFactors'=> json_decode($situationalMethod->getGraphsAndTheirSituationalFactors())
        ]);
    }

    /**
     * @Route("/situational_method/delete/{id}", name="delete_situational_method")
     * @param int $id
     * @return Response
     */
    public function deleteSituationalMethod(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $situationalMethod = $entityManager->getRepository(SituationalMethod::class)->find($id);
        $entityManager->remove($situationalMethod);
        $entityManager->flush();

        return $this->redirectToRoute("situational_methods");
    }
}
