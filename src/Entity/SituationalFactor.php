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
     * @ORM\Column(type="array")
     */
    private $values;



    public function __construct()
    {
        $this->values = new ArrayCollection();
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


    public function addValue(string $value)
    {
        if(!$this->values->contains($value))
        {
            $this->values[] = $value;
        }
    }

    public function removeValue(string $value)
    {
        if($this->values->contains($value))
        {
            $this->values->removeElement($value);
        }
    }

    /**
     * @return array
     */
    public function getValues(): array
    {
        return $this->values->toArray();
    }

}
