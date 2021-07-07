<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    const TO_DO = 0;
    const UNDER_PROGRESS = 1;
    const CANCELLED = 2;
    const FINISHED = 3;


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
    private $inputArtifacts;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $outputArtifacts;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(type="array")
     */
    private $tools;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SituationalMethod", inversedBy="tasks", cascade={"persist","remove"})
     */
    private $situationalMethod;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function __construct()
    {
        $this->inputArtifacts = new ArrayCollection();
        $this->outputArtifacts = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->tools = new ArrayCollection();
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
     * @return array
     */
    public function getInputArtifacts()
    {
        return $this->inputArtifacts->toArray();
    }


    public function addInputArtifact(array $artifact)
    {
        $inputArtifacts = $this->inputArtifacts == null ? [] : $this->inputArtifacts->toArray();

        if (!in_array($artifact, $inputArtifacts))
            array_push($inputArtifacts, $artifact);

        $this->inputArtifacts = new ArrayCollection($inputArtifacts);
    }

    public function removeInputArtifact(array $artifact)
    {
        if ($this->inputArtifacts->contains($artifact)) {
            $this->inputArtifacts->removeElement($artifact);
        }
    }

    /**
     * @return array
     */
    public function getOutputArtifacts()
    {
        return $this->outputArtifacts->toArray();
    }

    public function addOutputArtifact(array $artifact)
    {
        $outputArtifacts = $this->outputArtifacts == null ? [] : $this->outputArtifacts->toArray();

        if (!in_array($artifact, $outputArtifacts))
            array_push($outputArtifacts, $artifact);

        $this->outputArtifacts = new ArrayCollection($outputArtifacts);
    }

    public function removeOutputArtifact(array $artifact)
    {
        if ($this->outputArtifacts->contains($artifact)) {
            $this->outputArtifacts->removeElement($artifact);
        }
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = new ArrayCollection($roles);
    }

    /**
     * @return array
     */
    public function getTools()
    {
        return $this->tools->toArray();
    }

    /**
     * @param array $tools
     */
    public function setTools(array $tools)
    {
        $this->tools = new ArrayCollection($tools);
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
