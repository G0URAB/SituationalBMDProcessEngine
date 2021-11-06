<?php

namespace App\Entity;

use App\Repository\ProcessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=ProcessRepository::class)
 * @UniqueEntity("name")
 */
class Process implements MethodElement
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
     * @ORM\ManyToOne(targetEntity="ProcessKind", inversedBy="processes")
     */
    private $processKind;

    /**
     * @ORM\ManyToMany(targetEntity="ProcessKind")
     * \@ORM\JoinTable(name="users_other_related_process_kinds",
     *      joinColumns={@JoinColumn(name="process_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="process_kind_id", referencedColumnName="id")}
     *      )
     */
    private $otherRelatedProcessKinds;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->otherRelatedProcessKinds = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProcessKind()
    {
        return $this->processKind;
    }

    /**
     * @param mixed $processKind
     */
    public function setParentProcessKind($processKind)
    {
        $this->processKind = $processKind;
    }


    /**
     * @return string
     */
    public function getImplodedOtherRelatedProcessKinds()
    {
        $processKindsArray = $this->otherRelatedProcessKinds->toArray();
        return implode(", ", $processKindsArray);
    }


    public function getOtherRelatedProcessKinds()
    {
        return $this->otherRelatedProcessKinds->toArray();
    }


    public function addOtherRelatedProcessKind($kind)
    {
        if (!$this->otherRelatedProcessKinds->contains($kind))
            $this->otherRelatedProcessKinds[] = $kind;
    }

    public function removeOtherRelatedProcessKind($kind)
    {
        if ($this->otherRelatedProcessKinds->contains($kind))
            $this->otherRelatedProcessKinds->removeElement($kind);
    }

    public function __toString()
    {
        return (string) $this->name;
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
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
