<?php

namespace App\Entity;

use App\Repository\GenericActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GenericActivityRepository::class)
 */
class GenericActivity
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
     * @ORM\OneToMany(targetEntity="App\Entity\Process", mappedBy="genericActivity", cascade={"persist", "remove"})
     */
    private $processes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BmdGraph", mappedBy="parentGenericActivity", cascade={"persist", "remove"})
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
            $process->setGenericActivity($this);
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
            $process->setGenericActivity(null);
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
            $childBmdGraph->setParentGenericActivity($this);
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
            $childBmdGraph->setParentGenericActivity(null);
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
