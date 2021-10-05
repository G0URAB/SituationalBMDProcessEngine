<?php

namespace App\Entity;

use App\Repository\BusinessTextRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BusinessTextRepository::class)
 */
class BusinessText
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
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessSegment", inversedBy="businessTexts")
     */
    private $businessSegment;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }


    /**
     * @return mixed
     */
    public function getBusinessSegment()
    {
        return $this->businessSegment;
    }

    /**
     * @param mixed $businessSegment
     */
    public function setBusinessSegment($businessSegment)
    {
        $this->businessSegment = $businessSegment;
    }
}
