<?php

namespace App\Entity;

use App\Repository\MatterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatterRepository::class)]
class Matter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $designation;

    #[ORM\Column(type: 'string', length: 10)]
    private $abbreviation;

    #[ORM\ManyToMany(targetEntity: Level::class, mappedBy: 'idMatter')]
    private $idLevel;

    public function __construct()
    {
        $this->idLevel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): self
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * @return Collection|Level[]
     */
    public function getIdLevel(): Collection
    {
        return $this->idLevel;
    }

    public function addIdLevel(Level $idLevel): self
    {
        if (!$this->idLevel->contains($idLevel)) {
            $this->idLevel[] = $idLevel;
            $idLevel->addIdMatter($this);
        }

        return $this;
    }

    public function removeIdLevel(Level $idLevel): self
    {
        if ($this->idLevel->removeElement($idLevel)) {
            $idLevel->removeIdMatter($this);
        }

        return $this;
    }
}
