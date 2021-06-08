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
class ProcessKind
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
     * @ORM\OneToMany(targetEntity="App\Entity\Process", mappedBy="processType", cascade={"persist", "remove"})
     */
    private $processes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BmdGraph", mappedBy="parentProcessType", cascade={"persist", "remove"})
     */
    private $childBMDGraphs;



    public function __construct()
    {
        $this->processes = new ArrayCollection();
        $this->childBMDGraphs = new ArrayCollection();
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
            $process->setProcessKind($this);
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
            $process->setProcessKind(null);
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


    /**
     * @return ArrayCollection
     */
    public function getProcesses(): ArrayCollection
    {
        return $this->processes;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildBMDGraphs(): ArrayCollection
    {
        return $this->childBMDGraphs;
    }
}
