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
     * @ORM\ManyToMany(targetEntity="App\Entity\BmdGraph", inversedBy="situationalFactors")
     */
    private $situationalFactors;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GenericActivity", inversedBy="childBMDGraphs")
     */
    private $parentGenericActivity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\GenericActivity")
     */
    private $childGenericActivities;

    public function __construct()
    {
        $this->childGenericActivities = new ArrayCollection();
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
    public function getChildGenericActivities(): ArrayCollection
    {
        return $this->childGenericActivities;
    }

    /**
     * @param GenericActivity $childGenericActivity
     */
    public function addChildGenericActivity(GenericActivity $childGenericActivity)
    {
        if(!$this->childGenericActivities->contains($childGenericActivity))
        {
            $this->childGenericActivities[]= $childGenericActivity;
        }
    }

    /**
     * @param GenericActivity $childGenericActivity
     */
    public function removeChildGenericActivity(GenericActivity $childGenericActivity)
    {
        if(!$this->childGenericActivities->contains($childGenericActivity))
        {
            $this->childGenericActivities->removeElement($childGenericActivity);
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
    public function getParentGenericActivity()
    {
        return $this->parentGenericActivity;
    }


    /**
     * @param mixed $parentGenericActivity
     */
    public function setParentGenericActivity($parentGenericActivity)
    {
        $this->parentGenericActivity = $parentGenericActivity;
    }
}
