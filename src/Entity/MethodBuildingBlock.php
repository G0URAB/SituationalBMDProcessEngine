<?php

namespace App\Entity;

use App\Repository\MethodBuildingBlockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MethodBuildingBlockRepository::class)
 * @UniqueEntity("process")
 */
class MethodBuildingBlock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Process", cascade={"persist","remove"})
     */
    private $process;

    /**
     * @ORM\Column(type="array")
     */
    private $inputArtifacts;

    /**
     * @ORM\Column(type="array")
     */
    private $outputArtifacts;

    /**
     * @ORM\Column(type="array")
     */
    private $situationalFactors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", cascade={"persist","remove"})
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tool", cascade={"persist","remove"})
     */
    private $tools;


    public function __construct()
    {
        $this->inputArtifacts = new ArrayCollection();
        $this->outputArtifacts = new ArrayCollection();
        $this->situationalFactors = new ArrayCollection();
        $this->tools = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInputArtifacts()
    {
        $array = gettype($this->inputArtifacts)=="array"? $this->inputArtifacts: $this->inputArtifacts->toArray();
        sort($array);
        return $array;
    }

    public function getImplodedInputArtifacts()
    {
        $inputArtifactsArray = $this->inputArtifacts->toArray();
        return implode(", ", $inputArtifactsArray);
    }

    public function setInputArtifacts(array $artifacts)
    {
        $this->inputArtifacts = new ArrayCollection($artifacts);
    }


    public function getOutputArtifacts()
    {
        $array = gettype($this->outputArtifacts)=="array"? $this->outputArtifacts: $this->outputArtifacts->toArray();
        sort($array);
        return $array;
    }

    public function getImplodedOutputArtifacts()
    {
        $outputArtifactsArray = $this->outputArtifacts->toArray();
        return implode(", ", $outputArtifactsArray);
    }

    public function setOutputArtifacts(array $artifacts)
    {
        $this->outputArtifacts = new ArrayCollection($artifacts);
    }

    public function setSituationalFactors(array $situationalFactors)
    {
        $this->situationalFactors = new ArrayCollection($situationalFactors);
    }

    public function getSituationalFactors()
    {
        return gettype($this->situationalFactors)=="array"? $this->situationalFactors: $this->situationalFactors->toArray();
    }

    public function getImplodedSituationalFactors()
    {
        $situationalFactorsArray = $this->situationalFactors->toArray();
        sort($situationalFactorsArray);
        return implode(", ", $situationalFactorsArray);
    }

    public function addTool(Tool $tool)
    {
        if (!$this->tools->contains($tool))
            $this->tools->add($tool);
    }

    public function removeTool(Tool $tool)
    {
        if ($this->tools->contains($tool)) {
            $this->tools->removeElement($tool);
        }
    }

    public function getTools()
    {
        return $this->tools;
    }

    public function getImplodedTools()
    {
        $toolsTypeArray = [];
        foreach ($this->tools->toArray() as $tool)
            $toolsTypeArray[] = $tool->getType();
        return implode(", ", $toolsTypeArray);
    }

    public function getExplodedTools()
    {
        $tools = [];
        foreach (explode(",", $this->getImplodedTools()) as $tool)
            array_push($tools, trim($tool));
        return $tools;
    }

    public function addRole(Role $role)
    {
        if (!$this->roles->contains($role))
            $this->roles->add($role);
    }

    public function removeRole(Role $role)
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function implodedRoles()
    {
        $rolesArray = [];
        foreach ($this->roles as $role)
            $rolesArray[] = $role->getName();
        return implode(", ", $rolesArray);
    }

    public function getExplodedRoles()
    {
        $roles = [];
        foreach (explode(",", $this->implodedRoles()) as $role)
            array_push($roles, trim($role));
        return $roles;
    }

    /**
     * @return mixed
     */
    public function getProcess()
    {
        return $this->process;
    }

    /**
     * @param mixed $process
     */
    public function setProcess($process)
    {
        $this->process = $process;
    }
}
