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
     * @ORM\ManyToOne(targetEntity="ProcessKind", inversedBy="processes")
     */
    private $parentProcessKind;

    /**
     * @ORM\ManyToMany(targetEntity="ProcessKind")
     * \@ORM\JoinTable(name="users_other_related_process_kinds",
     *      joinColumns={@JoinColumn(name="process_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="process_kind_id", referencedColumnName="id")}
     *      )
     */
    private $otherRelatedProcessKinds;

    public function __construct()
    {
        $this->otherRelatedProcessKinds = new ArrayCollection();
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
     * @return mixed
     */
    public function getParentProcessKind()
    {
        return $this->parentProcessKind;
    }

    /**
     * @param mixed $parentProcessKind
     */
    public function setParentProcessKind($parentProcessKind)
    {
        $this->parentProcessKind = $parentProcessKind;
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
        return $this->name;
    }
}
