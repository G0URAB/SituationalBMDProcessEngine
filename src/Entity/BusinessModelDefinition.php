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
    private $components;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    public function __construct()
    {
        $this->components = new ArrayCollection();
    }

    public function addComponent(string $component)
    {
        if (is_array($this->components) || $this->components==null)
        {
            $this->components = new ArrayCollection();
        }

        if (!$this->components->contains($component)) {
            $this->components[] = $component;
        }
    }

    public function removeComponent(string $component)
    {
        if ($this->components->contains($component)) {
            $this->components->removeElement($component);
        }
    }

    public function getImplodedComponents()
    {
        $componentsArray = gettype($this->components) == "array" ? $this->components : $this->components->toArray();
        return implode(", ", $componentsArray);
    }


    public function getComponents()
    {
        return $this->components;
    }

    public function setComponents(array $components)
    {
        $this->components = new ArrayCollection($components);
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
}
