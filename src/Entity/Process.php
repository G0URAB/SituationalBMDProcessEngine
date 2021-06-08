<?php

namespace App\Entity;

use App\Repository\ProcessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProcessRepository::class)
 * @UniqueEntity("name")
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
     * @ORM\ManyToMany(targetEntity="ProcessKind", inversedBy="processes")
     */
    private $processKinds;

    public function __construct()
    {
        $this->processKinds = new ArrayCollection();
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
     * @return string
     */
    public function getImplodedProcessKinds()
    {
        $processKindsArray =  $this->processKinds->toArray();
        return implode(", ",$processKindsArray);
    }


    public function getProcessKinds()
    {
        return $this->processKinds;
    }


    /**
     * @param ProcessKind $processKind
     */
    public function addProcessKind(ProcessKind $processKind)
    {
        if (!$this->processKinds->contains($processKind)) {
            $this->processKinds[] = $processKind;
        }
    }

    /**
     * @param ProcessKind $processKind
     */
    public function removeProcessKind(ProcessKind $processKind)
    {
        if ($this->processKinds->contains($processKind)) {
            $this->processKinds->removeElement($processKind);
        }
    }

}
