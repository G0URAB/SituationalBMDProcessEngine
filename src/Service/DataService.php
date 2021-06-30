<?php

namespace App\Service;

use App\Entity\Artifact;
use App\Entity\BmdGraph;
use App\Entity\MethodBuildingBlock;
use App\Entity\Process;
use App\Entity\ProcessKind;
use App\Entity\Role;
use App\Entity\SituationalFactor;
use App\Entity\SituationalMethod;
use App\Entity\Tool;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;


class DataService
{

    private $entityManager;
    private $situationalChoices = [];

    private $processes;
    private $processKinds;
    private $roles;
    private $artifacts;
    private $tools;
    private $situationalFactors;
    private $situationalMethods;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
        $this->roles = $em->getRepository(Role::class)->findAll();
        $this->artifacts = $em->getRepository(Artifact::class)->findAll();
        $this->processes = $em->getRepository(Process::class)->findAll();
        $this->processKinds = $em->getRepository(ProcessKind::class)->findAll();
        $this->tools = $em->getRepository(Tool::class)->findAll();
        $this->situationalFactors = $em->getRepository(SituationalFactor::class)->findAll();
        $this->situationalMethods = $em->getRepository(SituationalMethod::class)->findAll();
    }

    public function getAllProcessTypes()
    {
        return $this->processKinds;
    }

    public function getAllSituationalFactors()
    {
        return $this->situationalFactors;
    }

    public function getAllProcesses()
    {
        return $this->processes;
    }

    public function getAllTools()
    {
        return $this->tools;
    }

    public function getAllRoles()
    {
        return $this->roles;
    }

    public function getAllArtifacts()
    {
        return $this->artifacts;
    }

    public function getAllSituationalMethods()
    {
        return $this->situationalMethods;
    }

    public function getSituationalChoices(): array
    {
        $situationalFactors = $this->entityManager->getRepository(SituationalFactor::class)->findAll();

        $this->situationalChoices['All Situations'] = "All Situations";
        foreach ($situationalFactors as $situationalFactor) {
            foreach ($situationalFactor->getVariants() as $variant) {
                $this->situationalChoices [$situationalFactor->getName() . " : " . $variant] = $situationalFactor->getName() . " : " . $variant;
            }
        }
        asort($this->situationalChoices);

        return $this->situationalChoices;
    }

    public function processBMDGraph($bmdGraph, $nodes, $edges)
    {
        $id_of_new_process_types = [];
        $id_of_old_process_types = [];
        $id_of_process_types_to_remove = [];

        foreach ($bmdGraph->getChildProcessKinds() as $processKind)
            array_push($id_of_old_process_types, $processKind->getId());

        //Add child-processes to the graph
        foreach ($nodes as $node) {
            if ($node["shape"] === "box") {
                array_push($id_of_new_process_types, $node["tableId"]);
                $childProcessType = $this->entityManager->getRepository(ProcessKind::class)->find($node["tableId"]);
                $bmdGraph->addChildProcessKind($childProcessType);
            }
        }

        //find old process types that needs to be removed
        foreach ($id_of_old_process_types as $oldId) {
            if (!in_array($oldId, $id_of_new_process_types))
                array_push($id_of_process_types_to_remove, $oldId);
        }

        //Remove child-process from the graph
        foreach ($id_of_process_types_to_remove as $id) {
            foreach ($bmdGraph->getChildProcessKinds()->toArray() as $processType) {
                if ($processType->getId() == $id) {
                    $bmdGraph->removeChildProcessKind($processType);
                }

            }
        }

        $bmdGraph->setNodes(json_encode($nodes));
        $bmdGraph->setEdges(json_encode($edges));

        return $bmdGraph;
    }


    public function checkIfMethodBlockIsSituationSpecific(MethodBuildingBlock $methodBlock, BmdGraph $bmdGraph): bool
    {
        $methodBlockIsSituationSpecific = false;

        if (in_array("All Situations", (array)$bmdGraph->getSituationalFactors()))
            return true;

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

    public function getMethodBlockObject(MethodBuildingBlock $methodBlock): stdClass
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

    public function getBMDGraphObject(BmdGraph $graph): stdClass
    {
        $obj = new stdClass;
        $obj->id = $graph->getId();
        $obj->name = $graph->getName();
        $obj->nodes = $graph->getNodes();
        $obj->edges = $graph->getEdges();
        $obj->situationalFactors = $graph->getImplodedSituationalFactors();

        return $obj;
    }
}