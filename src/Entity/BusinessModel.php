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
     * @ORM\OneToMany(targetEntity="BusinessComponent", mappedBy="businessModel", cascade={"persist","remove"})
     */
    private $components;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function __construct()
    {
        $this->components = new ArrayCollection();
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


    public function getComponents()
    {
        return $this->components;
    }

    public function addComponent(BusinessComponent $component)
    {
        if(!$this->components->contains($component))
        {
            $this->components->add($component);
            $component->setBusinessModel($this);
        }
    }

    public function removeComponent(BusinessComponent $component)
    {
        if($this->components->contains($component))
        {
            $component->setBusinessModel(null);
            $this->components->removeElement($component);
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