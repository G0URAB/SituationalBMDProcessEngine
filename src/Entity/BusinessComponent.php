<?php

namespace App\Entity;

use App\Repository\BusinessComponentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BusinessComponentRepository::class)
 */
class BusinessComponent
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
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessModel", inversedBy="components")
     */
    private $businessModel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BusinessText", mappedBy="businessComponent", cascade={"persist","remove"})
     */
    private $businessTexts;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $log;

    public function __construct()
    {
        $this->businessTexts = new ArrayCollection();
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
    public function getBusinessModel()
    {
        return $this->businessModel;
    }

    /**
     * @param mixed $businessModel
     */
    public function setBusinessModel($businessModel)
    {
        $this->businessModel = $businessModel;
    }


    /**
     * @return mixed
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param mixed $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }


    public function getBusinessTexts()
    {
        return $this->businessTexts;
    }

    public function addBusinessText(BusinessText $businessText)
    {
        $newText = true;
        foreach ($this->businessTexts as $text) {
            if ($text->getValue() == $businessText->getValue())
                $newText = false;
        }

        if ($newText) {
            $businessText->setBusinessComponent($this);
            $this->businessTexts->add($businessText);
        }
    }

    public function removeBusinessText(BusinessText $businessText)
    {
        $businessText->setBusinessComponent(null);
        $this->businessTexts->removeElement($businessText);
    }

}
