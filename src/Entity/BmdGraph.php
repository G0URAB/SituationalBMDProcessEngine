<?php

namespace App\Entity;

use App\Repository\BmdGraphRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BmdGraphRepository::class)
 */
class BmdGraph
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="array")
     */
    private $situationalFactors;

    /**
     * @ORM\ManyToOne(targetEntity="ProcessKind", inversedBy="childBMDGraphs")
     */
    private $parentProcessKind;

    /**
     * @ORM\ManyToMany(targetEntity="ProcessKind")
     */
    private $childProcessKinds;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $nodes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $edges;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    public function __construct()
    {
        $this->childProcessKinds = new ArrayCollection();
        $this->situationalFactors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getChildProcessKinds()
    {
        return $this->childProcessKinds;
    }

    /**
     * @param ProcessKind $processType
     */
    public function addChildProcessKind(ProcessKind $processType)
    {
        if(!$this->childProcessKinds->contains($processType))
        {
            $this->childProcessKinds[]= $processType;
        }
    }

    /**
     * @param ProcessKind $processType
     */
    public function removeChildProcessKind(ProcessKind $processType)
    {
        if($this->childProcessKinds->contains($processType))
        {
            $this->childProcessKinds->removeElement($processType);
        }
    }

    public function getImplodedChildrenProcessTypes()
    {
        $array = $this->childProcessKinds->toArray();
        return implode(", ",$array);
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
        $situationalFactorsArray = gettype($this->situationalFactors)=="array"? $this->situationalFactors : $this->situationalFactors->toArray();
        sort($situationalFactorsArray);
        return implode(", ", $situationalFactorsArray);
    }

    /**
     * @return mixed
     */
    public function getParentProcessKind()
    {
        return $this->parentProcessKind;
    }


    /**
     * @param mixed $parentProcessType
     */
    public function setParentProcessKind($parentProcessType)
    {
        $this->parentProcessKind = $parentProcessType;
    }

    /**
     * @return mixed
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * @param mixed $nodes
     */
    public function setNodes($nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * @return mixed
     */
    public function getEdges()
    {
        return $this->edges;
    }

    /**
     * @param mixed $edges
     */
    public function setEdges($edges)
    {
        $this->edges = $edges;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

}
