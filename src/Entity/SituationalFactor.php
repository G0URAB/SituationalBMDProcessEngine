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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getVariants()
    {
        return $this->variants;
    }

}
