<?php

namespace App\Entity;

use App\Repository\EmployeeNovityEvaluationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeNovityEvaluationRepository::class)]
class EmployeeNovityEvaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $integration = null;

    #[ORM\Column(length: 45)]
    private ?string $model = null;

    #[ORM\Column(length: 45)]
    private ?string $communication = null;

    #[ORM\Column(length: 45)]
    private ?string $professionnal = null;

    #[ORM\Column(length: 45)]
    private ?string $excellence = null;

    #[ORM\Column(length: 45)]
    private ?string $audacity = null;

    #[ORM\Column(length: 45)]
    private ?string $humanity = null;

    #[ORM\Column(length: 45)]
    private ?string $examiner = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation_info = null;

    #[ORM\ManyToOne(inversedBy: 'employeeNovityEvaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employee = null;

    #[ORM\ManyToOne(inversedBy: 'employeeNovityEvaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntegration(): ?string
    {
        return $this->integration;
    }

    public function setIntegration(string $integration): self
    {
        $this->integration = $integration;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getCommunication(): ?string
    {
        return $this->communication;
    }

    public function setCommunication(string $communication): self
    {
        $this->communication = $communication;

        return $this;
    }

    public function getProfessionnal(): ?string
    {
        return $this->professionnal;
    }

    public function setProfessionnal(string $professionnal): self
    {
        $this->professionnal = $professionnal;

        return $this;
    }

    public function getExcellence(): ?string
    {
        return $this->excellence;
    }

    public function setExcellence(string $excellence): self
    {
        $this->excellence = $excellence;

        return $this;
    }

    public function getAudacity(): ?string
    {
        return $this->audacity;
    }

    public function setAudacity(string $audacity): self
    {
        $this->audacity = $audacity;

        return $this;
    }

    public function getHumanity(): ?string
    {
        return $this->humanity;
    }

    public function setHumanity(string $humanity): self
    {
        $this->humanity = $humanity;

        return $this;
    }

    public function getExaminer(): ?string
    {
        return $this->examiner;
    }

    public function setExaminer(string $examiner): self
    {
        $this->examiner = $examiner;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getDateCreationInfo(): ?\DateTimeInterface
    {
        return $this->date_creation_info;
    }

    public function setDateCreationInfo(\DateTimeInterface $date_creation_info): self
    {
        $this->date_creation_info = $date_creation_info;

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
}
