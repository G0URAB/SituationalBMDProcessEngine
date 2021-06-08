<?php

namespace App\Entity;

use App\Repository\ToolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ToolRepository::class)
 * @UniqueEntity("type")
 */
class Tool
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
    private $variants;


    public function __construct()
    {
        $this->variants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function addVariant(string $variant)
    {
        if(!$this->variants->contains($variant))
        {
            $this->variants[] = $variant;
        }
    }

    public function removeVariant(string $variant)
    {
        if($this->variants->contains($variant))
        {
            $this->variants->removeElement($variant);
        }
    }

    public function getImplodedVariants()
    {
        $variantsArray = $this->variants->toArray();
        return implode(", ",$variantsArray);
    }


    public function getVariants()
    {
        return $this->variants;
    }


    public function setVariants(array $variants)
    {
        $this->variants = new ArrayCollection($variants);
    }
}
