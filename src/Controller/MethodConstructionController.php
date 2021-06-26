<?php

namespace App\Controller;

use App\Entity\BmdGraph;
use App\Entity\MethodBuildingBlock;
use App\Entity\Process;
use App\Entity\ProcessKind;
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
     * @Route("/construct/situational_method", name="construct_situational_method")
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

            return $this->render('method_construction/index.html.twig', [
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
                        $matchingGraphs[] = $this->getBMDGraphObject($graph);
                    }

                }
            }
            return new JsonResponse(['status' => "ok", 'graphs' => $matchingGraphs]);
        }

        if ($request->get("request_type") == "get_method_blocks") {
            $bmdGraph = $this->getDoctrine()->getRepository(BmdGraph::class)->findOneBy([
                'name' => $request->get("graph_name")
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

                if ($this->checkIfMethodBlockIsSituationSpecific($methodBlock, $bmdGraph))
                    $situationSpecificMethodBuildingBlocks[] = $this->getMethodBlockObject($methodBlock);
            }

            //Also check which other processes can also be used in this process type
            $allProcesses = $this->getDoctrine()->getRepository(Process::class)->findAll();
            foreach ($allProcesses as $process) {
                if (in_array($processType, $process->getOtherRelatedProcessKinds())) {
                    $methodBlock = $this->getDoctrine()->getRepository(MethodBuildingBlock::class)->findOneBy([
                        'process' => $process
                    ]);

                    if ($this->checkIfMethodBlockIsSituationSpecific($methodBlock, $bmdGraph))
                        $situationSpecificMethodBuildingBlocks[] = $this->getMethodBlockObject($methodBlock);
                }
            }

            $graphsWithParentProcessType = $this->getDoctrine()->getRepository(BmdGraph::class)->findBy([
                'parentProcessKind' => $processType
            ]);
            if ($graphsWithParentProcessType) {
                foreach ($graphsWithParentProcessType as $probableSituationSpecificGraph) {
                    if ($this->checkIfMethodBlockIsSituationSpecific($probableSituationSpecificGraph, $bmdGraph) && $probableSituationSpecificGraph->getId() !== $bmdGraph->getId())
                        $situationSpecificBMDGraphs[] = $this->getBMDGraphObject($probableSituationSpecificGraph);
                }
            }

            return new JsonResponse(['blocks' => $situationSpecificMethodBuildingBlocks, 'graphs' => $situationSpecificBMDGraphs]);
        }

        return new Response("Invalid request", 400);
    }


    public function checkIfMethodBlockIsSituationSpecific($methodBlock, $bmdGraph)
    {
        $methodBlockIsSituationSpecific = false;

        if ($methodBlock) {

            $matchedSituationalFactors = 0;
            $totalSituationalFactors = 0;

            foreach ($methodBlock->getSituationalFactors() as $factor) {
                if (in_array($factor, $bmdGraph->getSituationalFactors()))
                    $matchedSituationalFactors++;
                $totalSituationalFactors++;
            }

            /*
             * If percentage of situational factors are more than or equal to 50% then recommend the method block.
             * If the method block can be used in all situation, then recommend it as well.
             */
            $percentageOfSituationalApplicability = ($matchedSituationalFactors / $totalSituationalFactors) * 100;
            if ($percentageOfSituationalApplicability >= 50 || in_array("All Situations", (array)$methodBlock->getSituationalFactors())) {
                $methodBlockIsSituationSpecific = true;
            }
        }

        return $methodBlockIsSituationSpecific;
    }

    public function getMethodBlockObject($methodBlock)
    {
        $obj = new stdClass;
        $obj->id = $methodBlock->getId();
        $obj->name = $methodBlock->getProcess()->getName();
        $obj->inputArtifacts = $methodBlock->getInputArtifacts();
        $obj->outputArtifacts = $methodBlock->getOutputArtifacts();
        $obj->roles = explode(", ", $methodBlock->implodedRoles());
        $obj->tools = explode(", ", $methodBlock->getImplodedTools());

        return $obj;
    }

    public function getBMDGraphObject($graph)
    {
        $obj = new stdClass;
        $obj->id = $graph->getId();
        $obj->name = $graph->getName();
        $obj->nodes = $graph->getNodes();
        $obj->edges = $graph->getEdges();
        $obj->situationalFactors = $graph->getImplodedSituationalFactors();

        return $obj;
    }


    /**
     * @Route("/handle/situational_method/construction", name="handle_situational_method_construction_request")
     * @param Request $request
     */
    public function handleSituationalMethodCreationRequest(Request $request)
    {

    }

}
