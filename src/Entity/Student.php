<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 50)]
    private $numMatricule;

    #[ORM\Column(type: 'string', length: 50)]
    private $address;

    #[ORM\Column(type: 'string', length: 10)]
    private $sex;

    #[ORM\Column(type: 'string', length: 20)]
    private $nationality;

    #[ORM\ManyToMany(targetEntity: Level::class, mappedBy: 'idStudent')]
    private $idLevel;

    #[ORM\Column(type: 'datetime_immutable')]
    private $dateAt;

    public function __construct()
    {
        $this->idLevel = new ArrayCollection();
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getNumMatricule(): ?string
    {
        return $this->numMatricule;
    }

    public function setNumMatricule(string $numMatricule): self
    {
        $this->numMatricule = $numMatricule;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

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
            $idLevel->addIdStudent($this);
        }

        return $this;
    }

    public function removeIdLevel(Level $idLevel): self
    {
        if ($this->idLevel->removeElement($idLevel)) {
            $idLevel->removeIdStudent($this);
        }

        return $this;
    }

    public function getDateAt(): ?\DateTimeImmutable
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeImmutable $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }
}
