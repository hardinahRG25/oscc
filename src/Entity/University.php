<?php

namespace App\Entity;

use App\Repository\UniversityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniversityRepository::class)]
class University
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    private ?string $nameUniversity = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'universityHome')]
    private Collection $universityUserHome;

    public function __construct()
    {
        $this->universityUserHome = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameUniversity(): ?string
    {
        return $this->nameUniversity;
    }

    public function setNameUniversity(string $nameUniversity): self
    {
        $this->nameUniversity = $nameUniversity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUniversityUserHome(): Collection
    {
        return $this->universityUserHome;
    }

    public function addUniversityUserHome(User $universityUserHome): self
    {
        if (!$this->universityUserHome->contains($universityUserHome)) {
            $this->universityUserHome->add($universityUserHome);
            $universityUserHome->addUniversityHome($this);
        }

        return $this;
    }

    public function removeUniversityUserHome(User $universityUserHome): self
    {
        if ($this->universityUserHome->removeElement($universityUserHome)) {
            $universityUserHome->removeUniversityHome($this);
        }

        return $this;
    }
}
