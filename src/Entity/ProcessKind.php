<?php

namespace App\Entity;

use App\Repository\ProcessKindRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProcessKindRepository::class)
 * @UniqueEntity("name")
 */
class ProcessKind implements MethodElement
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
     * @ORM\OneToMany(targetEntity="App\Entity\Process", mappedBy="processKind", cascade={"persist", "remove"})
     */
    private $processes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BmdGraph", mappedBy="parentProcessKind", cascade={"persist", "remove"})
     */
    private $childBMDGraphs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProcessKind", inversedBy="childProcessKinds")
     */
    private $parentProcessKind;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProcessKind", mappedBy="parentProcessKind", cascade={"persist", "remove"})
     */
    private $childProcessKinds;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    public function __construct()
    {
        $this->processes = new ArrayCollection();
        $this->childBMDGraphs = new ArrayCollection();
        $this->childProcessKinds = new ArrayCollection();
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

    /**
     * @param Process $process
     */
    public function addProcess(Process $process)
    {
        if (!$this->processes->contains($process)) {
            $this->processes[] = $process;
        }
    }

    /**
     * @param Process $process
     * Before removing make sure the process is assigned to
     * another generic activity.
     */
    public function removeProcess(Process $process)
    {
        if ($this->processes->contains($process)) {
            $this->processes->removeElement($process);
        }
    }

    /**
     * @param BmdGraph $childBmdGraph
     */
    public function addChildBmdGraph(BmdGraph $childBmdGraph)
    {
        if (!$this->childBMDGraphs->contains($childBmdGraph)) {
            $this->childBMDGraphs[] = $childBmdGraph;
            $childBmdGraph->setParentProcessKind($this);
        }
    }

    /**
     * @param BmdGraph $childBmdGraph
     * Before removing make sure the child BMD graph is assigned to
     * another parent generic activity.
     */
    public function removeChildBmdGraph(BmdGraph $childBmdGraph)
    {
        if ($this->childBMDGraphs->contains($childBmdGraph)) {
            $childBmdGraph->setParentProcessKind(null);
            $this->childBMDGraphs->removeElement($childBmdGraph);
        }
    }


    public function getProcesses()
    {
        return $this->processes;
    }

    public function getImplodedProcesses()
    {
        $array = $this->processes->toArray();
        return implode(", ",$array);
    }


    public function getChildBMDGraphs()
    {
        return $this->childBMDGraphs;
    }


    /**
     * @return mixed
     */
    public function getParentProcessKind()
    {
        return $this->parentProcessKind;
    }

    /**
     * @param mixed $parentProcessKind
     */
    public function setParentProcessKind($parentProcessKind)
    {
        $this->parentProcessKind = $parentProcessKind;
    }

    public function addChildProcessKind(ProcessKind $childProcessKind)
    {
        if(!$this->childProcessKinds->contains($childProcessKind))
        {
            $this->childProcessKinds[]= $childProcessKind;
            $childProcessKind->setParentProcessKind($this);
        }
    }

    public function removeChildProcessKind(ProcessKind $childProcessKind)
    {
        if($this->childProcessKinds->contains($childProcessKind))
        {
            $this->childProcessKinds->removeElement($childProcessKind);
            $childProcessKind->setParentProcessKind(null);
        }
    }


    public function getChildProcessKinds()
    {
        return $this->childProcessKinds;
    }

    public function __toString()
    {
        return $this->name;
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
