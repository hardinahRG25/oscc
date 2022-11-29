<?php

namespace App\Entity;

use App\Repository\TypeActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeActivityRepository::class)]
class TypeActivity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nameActivity = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'typeActivity', targetEntity: Customer::class)]
    private Collection $cusActivity;

    public function __construct()
    {
        $this->cusActivity = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function __toString()
    {
        return $this->nameActivity;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameActivity(): ?string
    {
        return $this->nameActivity;
    }

    public function setNameActivity(string $nameActivity): self
    {
        $this->nameActivity = $nameActivity;

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
    public function getCusActivity(): Collection
    {
        return $this->cusActivity;
    }

    public function addCusActivity(Customer $cusActivity): self
    {
        if (!$this->cusActivity->contains($cusActivity)) {
            $this->cusActivity->add($cusActivity);
            $cusActivity->setTypeActivity($this);
        }

        return $this;
    }

    public function removeCusActivity(Customer $cusActivity): self
    {
        if ($this->cusActivity->removeElement($cusActivity)) {
            // set the owning side to null (unless already changed)
            if ($cusActivity->getTypeActivity() === $this) {
                $cusActivity->setTypeActivity(null);
            }
        }

        return $this;
    }
}
