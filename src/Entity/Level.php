<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $designation;

    #[ORM\Column(type: 'string', length: 10)]
    private $abbreviation;

    #[ORM\ManyToMany(targetEntity: UserEntity::class, mappedBy: 'idLevel')]
    private $idUser;

    #[ORM\ManyToMany(targetEntity: Matter::class, inversedBy: 'idLevel')]
    private $idMatter;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'idLevel')]
    private $idStudent;

    #[ORM\Column(type: 'string', length: 20)]
    private $cycle;

    public function __construct()
    {
        $this->idUser = new ArrayCollection();
        $this->idMatter = new ArrayCollection();
        $this->idStudent = new ArrayCollection();
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
     * @return Collection|UserEntity[]
     */
    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(UserEntity $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser[] = $idUser;
            $idUser->addIdLevel($this);
        }

        return $this;
    }

    public function removeIdUser(UserEntity $idUser): self
    {
        if ($this->idUser->removeElement($idUser)) {
            $idUser->removeIdLevel($this);
        }

        return $this;
    }

    /**
     * @return Collection|Matter[]
     */
    public function getIdMatter(): Collection
    {
        return $this->idMatter;
    }

    public function addIdMatter(Matter $idMatter): self
    {
        if (!$this->idMatter->contains($idMatter)) {
            $this->idMatter[] = $idMatter;
        }

        return $this;
    }

    public function removeIdMatter(Matter $idMatter): self
    {
        $this->idMatter->removeElement($idMatter);

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getIdStudent(): Collection
    {
        return $this->idStudent;
    }

    public function addIdStudent(Student $idStudent): self
    {
        if (!$this->idStudent->contains($idStudent)) {
            $this->idStudent[] = $idStudent;
        }

        return $this;
    }

    public function removeIdStudent(Student $idStudent): self
    {
        $this->idStudent->removeElement($idStudent);

        return $this;
    }

    public function getCycle(): ?string
    {
        return $this->cycle;
    }

    public function setCycle(string $cycle): self
    {
        $this->cycle = $cycle;

        return $this;
    }
}
