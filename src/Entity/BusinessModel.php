<?php

namespace App\Entity;

use App\Repository\BusinessModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=BusinessModelRepository::class)
 * @UniqueEntity("type")
 */
class BusinessModel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BusinessSegment", mappedBy="businessModel", cascade={"persist","remove"})
     */
    private $segments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function __construct()
    {
        $this->segments = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getSegments()
    {
        return $this->segments;
    }

    public function addSegment(BusinessSegment $segment)
    {
        if(!$this->segments->contains($segment))
        {
            $this->segments->add($segment);
            $segment->setBusinessModel($this);
        }
    }

    public function removeSegment(BusinessSegment $segment)
    {
        if($this->segments->contains($segment))
        {
            $segment->setBusinessModel(null);
            $this->segments->removeElement($segment);
        }
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}