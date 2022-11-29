<?php

namespace App\Entity;

use App\Repository\BusinessSectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusinessSectorRepository::class)]
class BusinessSector
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nameSector = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'businessSector', targetEntity: Customer::class)]
    private Collection $cusSector;

    public function __construct()
    {
        $this->cusSector = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function __toString()
    {
        return $this->nameSector;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSector(): ?string
    {
        return $this->nameSector;
    }

    public function setNameSector(string $nameSector): self
    {
        $this->nameSector = $nameSector;

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
    public function getCusSector(): Collection
    {
        return $this->cusSector;
    }

    public function addCusSector(Customer $cusSector): self
    {
        if (!$this->cusSector->contains($cusSector)) {
            $this->cusSector->add($cusSector);
            $cusSector->setBusinessSector($this);
        }

        return $this;
    }

    public function removeCusSector(Customer $cusSector): self
    {
        if ($this->cusSector->removeElement($cusSector)) {
            // set the owning side to null (unless already changed)
            if ($cusSector->getBusinessSector() === $this) {
                $cusSector->setBusinessSector(null);
            }
        }

        return $this;
    }
}
