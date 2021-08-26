<?php

namespace App\Entity;

use App\Repository\CancelledMethodBlockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CancelledMethodBlockRepository::class)
 */
class CancelledMethodBlock
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
     * @ORM\Column(type="string", length=255)
     */
    private $reason;


    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $jsonData;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SituationalMethod", inversedBy="cancelledMethodBlocks")
     */
    private $situationalMethod;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateTime;


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

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSituationalMethod()
    {
        return $this->situationalMethod;
    }

    /**
     * @param mixed $situationalMethod
     */
    public function setSituationalMethod($situationalMethod)
    {
        $this->situationalMethod = $situationalMethod;
    }

    /**
     * @return mixed
     */
    public function getJsonData()
    {
        return $this->jsonData;
    }

    /**
     * @param mixed $jsonData
     */
    public function setJsonData($jsonData)
    {
        $this->jsonData = $jsonData;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }
}
