<?php

namespace App\Entity;

use DateInterval;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\StackTechLanguage;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\MissionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
#[ApiResource]

class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $job = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_start = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_end = null;

    #[ORM\Column(length: 75, name: "mission_type")]
    private ?string $mission_type = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $reason_contract_end = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_create_info = null;

    private ?string $duration;

    #[ORM\ManyToOne(inversedBy: 'missionsUser')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employee = null;

    #[ORM\ManyToOne(inversedBy: 'missionsCustomer')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(length: 20)]
    private ?string $status = 'ENCOURS';

    #[ORM\ManyToMany(targetEntity: StackTechLanguage::class, inversedBy: 'missions')]
    private Collection $techPrincipal;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date_create_info = new \DateTimeImmutable();
        $this->techPrincipal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(?\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getMissionType(): ?string
    {
        return $this->mission_type;
    }

    public function setMissionType(string $mission_type): self
    {
        $this->mission_type = $mission_type;

        return $this;
    }

    public function getReasonContractEnd(): ?string
    {
        return $this->reason_contract_end;
    }

    public function setReasonContractEnd(?string $reason_contract_end): self
    {
        $this->reason_contract_end = $reason_contract_end;

        return $this;
    }

    public function getDateCreateInfo(): ?\DateTimeInterface
    {
        return $this->date_create_info;
    }

    public function setDateCreateInfo(\DateTimeInterface $date_create_info): self
    {
        $this->date_create_info = $date_create_info;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $response = '4342';
    }

    public function setDuration(?string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, StackTechLanguage>
     */
    public function getTechPrincipal(): Collection
    {
        return $this->techPrincipal;
    }

    public function addTechPrincipal(StackTechLanguage $techPrincipal): self
    {
        if (!$this->techPrincipal->contains($techPrincipal)) {
            $this->techPrincipal->add($techPrincipal);
        }

        return $this;
    }

    public function removeTechPrincipal(StackTechLanguage $techPrincipal): self
    {
        $this->techPrincipal->removeElement($techPrincipal);

        return $this;
    }
}
