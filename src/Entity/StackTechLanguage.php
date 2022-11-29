<?php

namespace App\Entity;

use App\Repository\StackTechLanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StackTechLanguageRepository::class)]
class StackTechLanguage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nameLanguage = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: Customer::class, mappedBy: 'listStack')]
    private Collection $listStacks;

    #[ORM\ManyToMany(targetEntity: Mission::class, mappedBy: 'techPrincipal')]
    private Collection $missions;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->listStacks = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nameLanguage;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameLanguage(): ?string
    {
        return $this->nameLanguage;
    }

    public function setNameLanguage(string $nameLanguage): self
    {
        $this->nameLanguage = $nameLanguage;

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
     * @return Collection<int, Customer>
     */
    public function getListStacks(): Collection
    {
        return $this->listStacks;
    }

    public function addListStack(Customer $listStack): self
    {
        if (!$this->listStacks->contains($listStack)) {
            $this->listStacks->add($listStack);
            $listStack->addListStack($this);
        }

        return $this;
    }

    public function removeListStack(Customer $listStack): self
    {
        if ($this->listStacks->removeElement($listStack)) {
            $listStack->removeListStack($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions->add($mission);
            $mission->addTechPrincipal($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeTechPrincipal($this);
        }

        return $this;
    }
}
