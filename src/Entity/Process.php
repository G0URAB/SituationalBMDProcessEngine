<?php

namespace App\Entity;

use App\Repository\ProcessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProcessRepository::class)
 */
class Process
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", inversedBy="processes")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artifact", inversedBy="processes")
     */
    private $artifacts;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SituationalFactor", inversedBy="processes")
     */
    private $situationalFactors;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GenericActivity", inversedBy="processes")
     */
    private $genericActivity;


    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->artifacts = new ArrayCollection();
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
     * @return GenericActivity
     */
    public function getGenericActivity()
    {
        return $this->genericActivity;
    }

    /**
     * @param $genericActivity
     */
    public function setGenericActivity($genericActivity)
    {
        $this->genericActivity = $genericActivity;
    }

    /**
     * @param Role $role
     */
    public function addRole(Role $role)
    {
        if(!$this->roles->contains($role))
        {
            $this->roles[] = $role;
        }
    }

    /**
     * @param Role $role
     */
    public function removeRole(Role $role)
    {
        if($this->roles->contains($role))
        {
            $this->roles->removeElement($role);
        }
    }

    /**
     * @param Artifact $artifact
     */
    public function addArtifact(Artifact $artifact)
    {
        if(!$this->artifacts->contains($artifact))
        {
            $this->artifacts[] = $artifact;
        }
    }

    /**
     * @param Artifact $artifact
     */
    public function removeArtifact(Artifact $artifact)
    {
        if($this->artifacts->contains($artifact))
        {
            $this->artifacts->removeElement($artifact);
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
    public function getRoles(): ArrayCollection
    {
        return $this->roles;
    }

    /**
     * @return ArrayCollection
     */
    public function getArtifacts(): ArrayCollection
    {
        return $this->artifacts;
    }

    /**
     * @return ArrayCollection
     */
    public function getSituationalFactors(): ArrayCollection
    {
        return $this->situationalFactors;
    }

    public function __toString()
    {
        return $this->name;
    }
}
