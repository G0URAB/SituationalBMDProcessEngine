<?php

namespace App\Entity;

use App\Repository\SituationalMethodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

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
    private $businessModelType;

    /**
     * One Product has One Shipment.
     * @OneToOne(targetEntity="App\Entity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $platformOwner;


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


    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $enacted = 0;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CancelledMethodBlock", mappedBy="situationalMethod")
     */
    private $cancelledMethodBlocks;


    public function __construct()
    {
        $this->bmdGraphsBeingUsed = new ArrayCollection();
        $this->cancelledMethodBlocks = new ArrayCollection();
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
    public function getPlatformOwner()
    {
        return $this->platformOwner;
    }

    /**
     * @param mixed $platformOwner
     */
    public function setPlatformOwner($platformOwner)
    {
        $this->platformOwner = $platformOwner;
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

    /**
     * @return bool
     */
    public function isEnacted()
    {
        return $this->enacted;
    }

    /**
     * @param bool $enacted
     */
    public function setEnacted(bool $enacted)
    {
        $this->enacted = $enacted;
    }

    public function addCancelledMethodBlock(CancelledMethodBlock $block)
    {
        if (!$this->cancelledMethodBlocks->contains($block))
        {
            $this->cancelledMethodBlocks->add($block);
            $block->setSituationalMethod($this);
        }

    }

    public function removeCancelledMethodBlock(CancelledMethodBlock $block)
    {
        if ($this->cancelledMethodBlocks->contains($block)) {
            $block->setSituationalMethod(null);
            $this->cancelledMethodBlocks->removeElement($block);
        }
    }

    public function getCancelledMethodBlocks()
    {
        return $this->cancelledMethodBlocks;
    }

    /**
     * @return mixed
     */
    public function getBusinessModelType()
    {
        return $this->businessModelType;
    }

    /**
     * @param mixed $businessModelType
     */
    public function setBusinessModelType($businessModelType)
    {
        $this->businessModelType = $businessModelType;
    }

}
