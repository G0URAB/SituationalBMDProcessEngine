<?php

namespace App\Controller;

use App\Entity\BmdGraph;
use App\Entity\MethodBuildingBlock;
use App\Entity\Process;
use App\Entity\ProcessKind;
use App\Entity\SituationalMethod;
use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Service\DataService;
use stdClass;
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
        return $this->render("method_construction/index.html.twig",[
            'situationalMethods'=>$dataService->getAllSituationalMethods()
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

            return $this->render('method_construction/construct.html.twig', [
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
            $bmdGraph = $this->getDoctrine()->getRepository(BmdGraph::class)->findOneBy([
                'name' => $request->get("root_graph_name")
            ]);

            $processType = $this->getDoctrine()->getRepository(ProcessKind::class)->findOneBy([
                'name' => $request->get("process_type")
            ]);

            $situationSpecificMethodBuildingBlocks = [];
            $situationSpecificBMDGraphs = [];

            foreach ($processType->getProcesses() as $process) {

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
     * @Route("/handle/situational_method/construction", name="handle_situational_method_construction_request")
     * @param Request $request
     * @param DataService $dataService
     * @param TaskRepository $taskRepository
     * @return JsonResponse|Response
     */
    public function handleSituationalMethodCreationRequest(Request $request, DataService $dataService, TaskRepository $taskRepository)
    {
        if ($request->isXmlHttpRequest()) {
            $nodes = $request->get("nodes");
            $edges = $request->get("edges");
            $tasks = $request->get("tasks");
            $nameOfSituationalMethod = $request->get("name_of_situational_method");
            $nameOfPlatformOwner = $request->get("platform_owner_name");
            $phoneOfPlatformOwner = $request->get("platform_owner_phone");
            $addressOfPlatformOwner = $request->get("platform_owner_address");

            $allRoles = [];
            foreach ($dataService->getAllRoles() as $role)
                array_push($allRoles, $role->getName());

            $allToolTypes = [];
            foreach ($dataService->getAllTools() as $tool)
                array_push($allToolTypes, $tool->getType());

            /*dd($nodes, $edges, $tasks, $nameOfSituationalMethod, $nameOfPlatformOwner, $phoneOfPlatformOwner, $addressOfPlatformOwner );*/
            $newSituationalMethod = new SituationalMethod();
            $newSituationalMethod->setName($nameOfSituationalMethod);
            $newSituationalMethod->setPlatformOwnerName($nameOfPlatformOwner);
            $newSituationalMethod->setPlatformOwnerPhone($phoneOfPlatformOwner);
            $newSituationalMethod->setPlatformOwnerAddress($addressOfPlatformOwner);
            $newSituationalMethod->setJsonNodes(json_encode($nodes));
            $newSituationalMethod->setJsonEdges(json_encode($edges));

            $entityManager = $this->getDoctrine()->getManager();

            foreach ($tasks as $task) {
                $inputArtifacts = [];
                $outputArtifacts = [];
                $roles = [];
                $tools = [];

                $taskEntity = new Task();
                $taskEntity->setStatus(Task::TO_DO);
                $taskEntity->setName($task['label']);

                foreach ($task['inputArtifacts'] as $key=>$value)
                    $inputArtifacts[$value] = null; //Null means empty file now

                foreach ($task['outputArtifacts'] as $key=>$value)
                    $outputArtifacts[$value] = null; //Null means empty file now

                $taskEntity->setInputArtifacts($inputArtifacts);
                $taskEntity->setOutputArtifacts($outputArtifacts);

                foreach ($task as $key => $value) {
                    if (in_array($key, $allRoles))
                        $roles[$key] = null; //Null means, no use has been assigned for this role yet

                    if (in_array($key, $allToolTypes))
                        $tools[$key] = null; //Null means, no tool has been selected for this tool type
                }

                $taskEntity->setRoles($roles);
                $taskEntity->setTools($tools);

                $task['tableId'] = count($taskRepository->findLastRecord())==0? 1: ($taskRepository->findLastRecord())[0]->getId() + 1;;

                $newSituationalMethod->addTask($taskEntity);
                $entityManager->persist($taskEntity);
            }

            $newSituationalMethod->setJsonTasks(json_encode($tasks));
            $entityManager->persist($newSituationalMethod);
            $entityManager->flush();

            return new JsonResponse(['status' => "okay", "msg" => "Situational Method Saved!!"]);
        }

        return new Response("Invalid Request", 400);
    }

}
