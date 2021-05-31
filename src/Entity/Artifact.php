<?php

namespace App\Entity;

use App\Repository\ArtifactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtifactRepository::class)
 */
class Artifact
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Process", mappedBy="artifacts", cascade={"persist","remove"})
     */
    private $processes;

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
    public function getProcesses()
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
            $process->addArtifact($this);
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
            $process->removeArtifact($this);
        }
    }
}
