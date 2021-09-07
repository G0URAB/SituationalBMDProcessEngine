<?php

namespace App\Entity;

use App\Repository\BusinessModelDefinitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=BusinessModelDefinitionRepository::class)
 * @UniqueEntity("type")
 */
class BusinessModelDefinition
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
    private $type;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $segments;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->segments = new ArrayCollection();
    }

    public function addSegment(string $segment)
    {
        if(!$this->segments->contains($segment))
        {
            $this->segments[] = $segment;
        }
    }

    public function removeSegment(string $segment)
    {
        if($this->segments->contains($segment))
        {
            $this->segments->removeElement($segment);
        }
    }

    public function getImplodedSegments()
    {
        $segmentsArray = gettype($this->segments)=="array"? $this->segments: $this->segments->toArray();
        return implode(", ",$segmentsArray);
    }


    public function getSegments()
    {
        return $this->segments;
    }

    public function setSegments(array $segments)
    {
        $this->segments = new ArrayCollection($segments);
    }

    public function __toString()
    {
        return $this->type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
