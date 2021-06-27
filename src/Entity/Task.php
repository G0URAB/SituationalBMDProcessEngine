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
     * @ORM\Column(type="array")
     */
    private $inputArtifacts;

    /**
     * @ORM\Column(type="array")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\SituationalMethod", inversedBy="tasks")
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

    /**
     * @param array $inputArtifacts
     */
    public function setInputArtifacts(array $inputArtifacts)
    {
        $this->inputArtifacts = new ArrayCollection($inputArtifacts);
    }

    /**
     * @return array
     */
    public function getOutputArtifacts()
    {
        return $this->outputArtifacts->toArray();
    }

    /**
     * @param array $outputArtifacts
     */
    public function setOutputArtifacts(array $outputArtifacts)
    {
        $this->outputArtifacts = new ArrayCollection($outputArtifacts);
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
