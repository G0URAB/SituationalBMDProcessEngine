<?php

namespace App\Service;

use App\Entity\Artifact;
use App\Entity\BmdGraph;
use App\Entity\BusinessModelDefinition;
use App\Entity\BusinessText;
use App\Entity\MethodBuildingBlock;
use App\Entity\Process;
use App\Entity\ProcessKind;
use App\Entity\Role;
use App\Entity\SituationalFactor;
use App\Entity\SituationalMethod;
use App\Entity\Tool;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;


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
    private $parameterBag;
    private $businessModelDefinitions;

    public function __construct(EntityManagerInterface $em, ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
        $this->entityManager = $em;
        $this->roles = $em->getRepository(Role::class)->findAll();
        $this->artifacts = $em->getRepository(Artifact::class)->findArtifactsInAscendingOrder();
        $this->processes = $em->getRepository(Process::class)->findAll();
        $this->processKinds = $em->getRepository(ProcessKind::class)->findAll();
        $this->tools = $em->getRepository(Tool::class)->findAll();
        $this->situationalFactors = $em->getRepository(SituationalFactor::class)->findAll();
        $this->situationalMethods = $em->getRepository(SituationalMethod::class)->findAll();
        $this->businessModelDefinitions = $em->getRepository(BusinessModelDefinition::class)->findAll();
    }

    public function getAllProcessTypes()
    {
        return $this->processKinds;
    }

    public function getAllSituationalFactors()
    {
        return $this->situationalFactors;
    }

    public function getAllBusinessModelDefinitions()
    {
        return $this->businessModelDefinitions;
    }

    public function getAllProcesses()
    {
        return $this->processes;
    }

    public function getAllTools()
    {
        return $this->tools;
    }

    public function getAllExplodedToolTypes()
    {
        $toolTypes = [];
        foreach ($this->tools as $tool)
            array_push($toolTypes, $tool->getType());
        return $toolTypes;
    }

    public function getAllRoles()
    {
        return $this->roles;
    }

    public function getAllExplodedRoles()
    {
        $roles = [];
        foreach ($this->roles as $role)
            array_push($roles, $role->getName());
        return $roles;
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

    public function processBMDGraph($bmdGraph, $nodes, $edges, $oldNameOfGraph = null)
    {
        $id_of_new_process_types = [];
        $id_of_old_process_types = [];
        $id_of_process_types_to_remove = [];

        foreach ($bmdGraph->getChildProcessKinds() as $processKind)
            array_push($id_of_old_process_types, $processKind->getId());

        //Add child-processes to the graph
        if ($nodes) {
            foreach ($nodes as $node) {
                if ($node["shape"] === "box") {
                    array_push($id_of_new_process_types, $node["tableId"]);
                    $childProcessType = $this->entityManager->getRepository(ProcessKind::class)->find($node["tableId"]);
                    $bmdGraph->addChildProcessKind($childProcessType);
                }
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

        if ($nodes)
            $bmdGraph->setNodes(json_encode($nodes));
        if ($edges)
            $bmdGraph->setEdges(json_encode($edges));

        /*if($oldNameOfGraph)
        {
            $situationalMethods = $this->getAllSituationalMethods();
            foreach ($situationalMethods as $situationalMethod)
            {
                $nodes = json_decode($situationalMethod->getJsonNodes());
                foreach ($nodes as $node)
                {
                    if(property_exists($node,'graphName'))
                    {
                        if($node->graphName===$oldNameOfGraph)
                            $node->graphName = $bmdGraph->getName();
                    }
                }
                $situationalMethod->setJsonNodes($nodes);
            }
        }*/

        return $bmdGraph;
    }


    public function checkIfMethodBlockIsSituationSpecific($methodBlock, $bmdGraph): bool
    {
        $methodBlockIsSituationSpecific = false;

        if ($this->isApplicableInAllSituations($bmdGraph->getSituationalFactors()))
            return true;

        if ($methodBlock) {

            $matchedSituationalFactors = 0;
            $totalSituationalFactorsOfGraph = sizeof($bmdGraph->getSituationalFactors());

            foreach ($methodBlock->getSituationalFactors() as $factor) {
                if (in_array($factor, $bmdGraph->getSituationalFactors()))
                    $matchedSituationalFactors++;
            }

            //If the methodBlock has more than one situational factors then calculate the percentage of situational
            //applicability
            if (sizeof($methodBlock->getSituationalFactors()) > 1) {
                /*
              * If percentage of situational factors are more than or equal to 50% then recommend the method block.
              * If the method block can be used in all situation, then recommend it as well.
              */
                $percentageOfSituationalApplicability = ($matchedSituationalFactors / $totalSituationalFactorsOfGraph) * 100;
                //dd($matchedSituationalFactors,$totalSituationalFactors,$percentageOfSituationalApplicability);
                if ($percentageOfSituationalApplicability >= 50) {
                    $methodBlockIsSituationSpecific = true;
                }
            } //Else if the methodBlock has only one situational factor which is present in the BMD graph then the block is situational
            else if ($matchedSituationalFactors == 1) {
                $methodBlockIsSituationSpecific = true;
            } else if ($this->isApplicableInAllSituations($methodBlock->getSituationalFactors())) {
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

    public function actualizeSituationalMethod(SituationalMethod $situationalMethod)
    {
        $actualizedTasks = [];
        $tasks = json_decode($situationalMethod->getJsonTasks());

        /*dd(
            getType(($tasks[0]->inputArtifacts)[0]->name)
        );*/

        foreach ($tasks as $task) {

            $block = $this->entityManager->getRepository(MethodBuildingBlock::class)->find($task->tableId);

            //If any role missing then add role to the task
            foreach ($block->getExplodedRoles() as $role) {
                if (!property_exists($task, $role)) {
                    $foo = (array)$task;
                    $foo[$role] = "";
                    $task = (object)$foo;
                }
            }

            //Remove any role from task if it has been already removed from a method block
            $currentTaskRoles = [];
            foreach ($task as $key => $value) {
                if (in_array($key, $this->getAllExplodedRoles()))
                    array_push($currentTaskRoles, $key);
            }
            foreach ($currentTaskRoles as $role) {
                if (!(in_array($role, (array)$block->getExplodedRoles())))
                    unset($task->$role);
            }

            //Remove duplicate roles
            foreach ($currentTaskRoles as $role) {
                if (property_exists($task, " " . $role)) {
                    $foo = (array)$task;
                    unset($foo[(" " . $role)]);
                    $task = (object)$foo;
                }
            }


            //If any tool missing then add the tool to the task
            foreach ($block->getExplodedTools() as $toolType) {
                if (!property_exists($task, $toolType)) {
                    $foo = (array)$task;
                    $foo[$toolType] = "";
                    $task = (object)$foo;
                }
            }

            //Remove any toolType from task if it has been already removed from a method block
            $currentToolTypes = [];
            foreach ($task as $key => $value) {
                if (in_array($key, $this->getAllExplodedToolTypes()))
                    array_push($currentToolTypes, $key);
            }
            foreach ($currentToolTypes as $toolType) {
                if (!(in_array($toolType, (array)$block->getExplodedTools())))
                    unset($task->$toolType);
            }

            //Check if input artifact needs to be added
            foreach ($block->getInputArtifacts() as $artifact) {
                $inputArtifactExist = false;
                foreach ($task->inputArtifacts as $inputArtifact) {
                    if (gettype($inputArtifact) == "object" && $inputArtifact->name == $artifact)
                        $inputArtifactExist = true;
                    else if ($inputArtifact == $artifact)
                        $inputArtifactExist = true;
                }
                if (!$inputArtifactExist) {
                    $foo = (array)$task;
                    $foo['inputArtifacts'] = gettype($foo['inputArtifacts']) == "object" ? (array)($foo['inputArtifacts']) : $foo['inputArtifacts'];
                    array_push($foo['inputArtifacts'], $artifact);
                    $task = (object)$foo;
                }
            }

            //Check if input artifact needs to deleted
            if (property_exists($task, "inputArtifacts")) {
                foreach ($task->inputArtifacts as $key => $inputArtifact) {
                    $inputArtifactNeedsToBeDeleted = false;
                    $artifactFilePath = null;

                    if (gettype($inputArtifact) == "object" && !in_array($inputArtifact->name, (array)$block->getInputArtifacts())) {
                        $inputArtifactNeedsToBeDeleted = true;
                        $artifactFilePath = str_replace("/images/artifacts/", "", $inputArtifact->path);
                    } else if (gettype($inputArtifact) !== "object" && !in_array($inputArtifact, (array)$block->getInputArtifacts()))
                        $inputArtifactNeedsToBeDeleted = true;

                    if ($inputArtifactNeedsToBeDeleted) {
                        unset($task->inputArtifacts[$key]);

                        if ($artifactFilePath) {
                            $fileSystem = new Filesystem();
                            $fileSystem->remove($this->parameterBag->get('kernel.project_dir') . "/public/images/artifacts/" . $artifactFilePath);
                        }

                    }
                }
            }

            //Check if output artifact needs to be added
            foreach ($block->getOutputArtifacts() as $artifact) {
                $outputArtifactExist = false;
                foreach ($task->outputArtifacts as $outputArtifact) {
                    if (gettype($outputArtifact) == "object" && $outputArtifact->name == $artifact)
                        $outputArtifactExist = true;
                    else if ($outputArtifact == $artifact)
                        $outputArtifactExist = true;
                }
                if (!$outputArtifactExist) {
                    $foo = (array)$task;
                    $foo['outputArtifacts'] = gettype($foo['outputArtifacts']) == "object" ? (array)($foo['outputArtifacts']) : $foo['outputArtifacts'];
                    array_push($foo['outputArtifacts'], $artifact);
                    $task = (object)$foo;
                }
            }

            //Check if output artifact needs to deleted
            if (property_exists($task, "outputArtifacts")) {
                foreach ($task->outputArtifacts as $key => $outputArtifact) {
                    $outputArtifactNeedsToBeDeleted = false;
                    $artifactFilePath = null;

                    if (gettype($outputArtifact) == "object" && !in_array($outputArtifact->name, (array)$block->getOutputArtifacts())) {
                        $outputArtifactNeedsToBeDeleted = true;
                        $artifactFilePath = str_replace("/images/artifacts/", "", $outputArtifact->path);
                    } else if (gettype($outputArtifact) !== "object" && !in_array($outputArtifact, (array)$block->getOutputArtifacts()))
                        $outputArtifactNeedsToBeDeleted = true;

                    if ($outputArtifactNeedsToBeDeleted) {
                        unset($task->outputArtifacts[$key]);

                        if ($artifactFilePath) {
                            $fileSystem = new Filesystem();
                            $fileSystem->remove($this->parameterBag->get('kernel.project_dir') . "/public/images/artifacts/" . $artifactFilePath);
                        }

                    }
                }
            }


            array_push($actualizedTasks, $task);
        }

        $situationalMethod->setJsonTasks(json_encode($actualizedTasks));
        $this->entityManager->flush();

        return $situationalMethod;
    }

    public function isApplicableInAllSituations(array $situationalFactors)
    {
        $applicable = false;

        foreach ($situationalFactors as $factor) {

            $applicable = strcasecmp(trim(explode(":", $factor)[0]), "All Situations") == 0;
            if ($applicable)
                break;

        }

        return $applicable;
    }

    public function getAllPlatformOwners()
    {
        $allUsers = $this->entityManager->getRepository(User::class)->findAll();
        $platformOwners = [];
        foreach ($allUsers as $user) {
            if (in_array('ROLE_PLATFORM_OWNER', $user->getRoles()))
                $platformOwners [] = $user;
        }
        return $platformOwners;
    }

    public function getAllBusinessModelTypes()
    {
        $businessModelTypes = [];
        $allBusinessModelDefinitions = $this->entityManager->getRepository(BusinessModelDefinition::class)->findAll();
        foreach ($allBusinessModelDefinitions as $definition) {
            if (!in_array($definition->getType(), $businessModelTypes))
                $businessModelTypes[] = $definition->getType();
        }

        return $businessModelTypes;
    }

}