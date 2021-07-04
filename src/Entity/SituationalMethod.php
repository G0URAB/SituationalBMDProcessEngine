<?php

namespace App\Entity;

use App\Repository\SituationalMethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SituationalMethodRepository::class)
 */
class SituationalMethod
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
    private $platformOwnerName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $platformOwnerPhone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $platformOwnerAddress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $platformOwnerEmail;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="situationalMethod", cascade={"persist","remove"})
     */
    private $tasks;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $jsonNodes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $jsonEdges;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $jsonTasks;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $bmdGraphsBeingUsed;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $graphsAndTheirSituationalFactors;


    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->bmdGraphsBeingUsed = new ArrayCollection();
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
    public function getPlatformOwnerName()
    {
        return $this->platformOwnerName;
    }

    /**
     * @param mixed $platformOwnerName
     */
    public function setPlatformOwnerName($platformOwnerName): void
    {
        $this->platformOwnerName = $platformOwnerName;
    }

    /**
     * @return mixed
     */
    public function getPlatformOwnerPhone()
    {
        return $this->platformOwnerPhone;
    }

    /**
     * @param mixed $platformOwnerPhone
     */
    public function setPlatformOwnerPhone($platformOwnerPhone): void
    {
        $this->platformOwnerPhone = $platformOwnerPhone;
    }

    /**
     * @return mixed
     */
    public function getPlatformOwnerAddress()
    {
        return $this->platformOwnerAddress;
    }

    /**
     * @param mixed $platformOwnerAddress
     */
    public function setPlatformOwnerAddress($platformOwnerAddress): void
    {
        $this->platformOwnerAddress = $platformOwnerAddress;
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * @param Task $task
     */
    public function addTask(Task $task)
    {
        if(!$this->tasks->contains($task))
        {
            $this->tasks[]= $task;
            $task->setSituationalMethod($this);
        }
    }

    /**
     * @param Task $task
     */
    public function removeTask(Task $task)
    {
        if($this->tasks->contains($task))
        {
            $task->setSituationalMethod(null);
            $this->tasks->removeElement($task);
        }
    }

    /**
     * @return mixed
     */
    public function getJsonNodes()
    {
        return $this->jsonNodes;
    }

    /**
     * @param mixed $jsonNodes
     */
    public function setJsonNodes($jsonNodes): void
    {
        $this->jsonNodes = $jsonNodes;
    }

    /**
     * @return mixed
     */
    public function getJsonEdges()
    {
        return $this->jsonEdges;
    }

    /**
     * @param mixed $jsonEdges
     */
    public function setJsonEdges($jsonEdges): void
    {
        $this->jsonEdges = $jsonEdges;
    }

    /**
     * @return mixed
     */
    public function getJsonTasks()
    {
        return $this->jsonTasks;
    }

    /**
     * @param mixed $jsonTasks
     */
    public function setJsonTasks($jsonTasks): void
    {
        $this->jsonTasks = $jsonTasks;
    }

    /**
     * @return mixed
     */
    public function getPlatformOwnerEmail()
    {
        return $this->platformOwnerEmail;
    }

    /**
     * @param mixed $platformOwnerEmail
     */
    public function setPlatformOwnerEmail($platformOwnerEmail): void
    {
        $this->platformOwnerEmail = $platformOwnerEmail;
    }

    /**
     * @return mixed
     */
    public function getBmdGraphsBeingUsed()
    {
        return $this->bmdGraphsBeingUsed->toArray();
    }

    /**
     * @param mixed $bmdGraphsBeingUsed
     */
    public function setBmdGraphsBeingUsed(array $bmdGraphsBeingUsed)
    {
        $this->bmdGraphsBeingUsed = new ArrayCollection($bmdGraphsBeingUsed);
    }

    /**
     * @return mixed
     */
    public function getGraphsAndTheirSituationalFactors()
    {
        return $this->graphsAndTheirSituationalFactors;
    }

    /**
     * @param mixed $graphsAndTheirSituationalFactors
     */
    public function setGraphsAndTheirSituationalFactors($graphsAndTheirSituationalFactors)
    {
        $this->graphsAndTheirSituationalFactors = $graphsAndTheirSituationalFactors;
    }
}
