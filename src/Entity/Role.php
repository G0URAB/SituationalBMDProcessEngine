<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Process", mappedBy="situationalFactors", cascade={"persist","remove"})
     */
    private $processes;


    public function __construct()
    {
        $this->situationalFactors = new ArrayCollection();
        $this->processes = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getProcesses(): ArrayCollection
    {
        return $this->processes;
    }

    /**
     * @param Process $process
     */
    public function addProcess(Process $process)
    {
        if(!$this->processes->contains($process))
        {
            $this->processes[] = $process;
            $process->addRole($this);
        }
    }

    /**
     * @param Process $process
     */
    public function removeProcess(Process $process)
    {
        if($this->processes->contains($process))
        {
            $this->processes->removeElement($process);
            $process->removeRole($this);
        }
    }
}
