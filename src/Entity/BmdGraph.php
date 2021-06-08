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
     * @ORM\ManyToMany(targetEntity="App\Entity\SituationalFactor")
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

    /**
     * @return ArrayCollection
     */
    public function getChildProcessKinds(): ArrayCollection
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
        if(!$this->childProcessKinds->contains($processType))
        {
            $this->childProcessKinds->removeElement($processType);
        }
    }

    /**
     * @param SituationalFactor $situationalFactor
     */
    public function addSituationalFactor(SituationalFactor $situationalFactor)
    {
        if(!$this->situationalFactors->contains($situationalFactor))
        {
            $this->situationalFactors[] = $situationalFactor;
        }
    }

    /**
     * @param SituationalFactor $situationalFactor
     */
    public function removeSituationalFactor(SituationalFactor $situationalFactor)
    {
        if($this->situationalFactors->contains($situationalFactor))
        {
            $this->situationalFactors->removeElement($situationalFactor);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getSituationalFactors(): ArrayCollection
    {
        return $this->situationalFactors;
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
}
