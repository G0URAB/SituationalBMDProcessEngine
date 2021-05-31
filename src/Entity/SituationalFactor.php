<?php

namespace App\Entity;

use App\Repository\SituationalFactorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SituationalFactorRepository::class)
 */
class SituationalFactor
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Process", mappedBy="situationalFactors", cascade={"persist","remove"})
     */
    private $processes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BmdGraph", mappedBy="situationalFactors", cascade={"persist","remove"})
     */
    private $bmdGraphs;

    public function __construct()
    {
        $this->processes = new ArrayCollection();
        $this->bmdGraphs = new ArrayCollection();
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


    public function addProcess(Process $process)
    {
        if(!$this->processes->contains($process))
        {
            $this->processes[] = $process;
            $process->addSituationalFactor($this);
        }
    }

    public function removeProcess(Process $process)
    {
        if($this->processes->contains($process))
        {
            $this->processes->removeElement($process);
            $process->removeSituationalFactor($this);
        }
    }


    public function addBmdGraph(BmdGraph $bmdGraph)
    {
        if($this->bmdGraphs->contains($bmdGraph))
        {
            $this->bmdGraphs->removeElement($bmdGraph);
            $bmdGraph->removeSituationalFactor($this);
        }
    }

    public function removeBmdGraph(BmdGraph $bmdGraph)
    {
        if($this->bmdGraphs->contains($bmdGraph))
        {
            $this->bmdGraphs->removeElement($bmdGraph);
            $bmdGraph->removeSituationalFactor($this);
        }
    }


    /**
     * @return ArrayCollection
     */
    public function getProcesses(): ArrayCollection
    {
        return $this->processes;
    }

}
