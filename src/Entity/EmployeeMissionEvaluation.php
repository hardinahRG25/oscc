<?php

namespace App\Entity;

use App\Repository\EmployeeMissionEvaluationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeMissionEvaluationRepository::class)]
class EmployeeMissionEvaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $technical_skills = null;

    #[ORM\Column(length: 45)]
    private ?string $productivity = null;

    #[ORM\Column(length: 45)]
    private ?string $rigour = null;

    #[ORM\Column(length: 45)]
    private ?string $autonomy = null;

    #[ORM\Column(length: 45)]
    private ?string $communication = null;

    #[ORM\Column(length: 45)]
    private ?string $reactivity = null;

    #[ORM\Column(length: 45)]
    private ?string $disponibility = null;

    #[ORM\Column(length: 45)]
    private ?string $involvement = null;

    #[ORM\Column(length: 45)]
    private ?string $proactive = null;

    #[ORM\Column(length: 45)]
    private ?string $initiative = null;

    #[ORM\Column(length: 45)]
    private ?string $teamwork = null;

    #[ORM\Column(length: 45)]
    private ?string $versality = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_create_info = null;

    #[ORM\Column(length: 45)]
    private ?string $examiner = null;

    #[ORM\ManyToOne(inversedBy: 'employeeMissionEvaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employee = null;

    #[ORM\ManyToOne(inversedBy: 'employeeMissionEvaluations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechnicalSkills(): ?string
    {
        return $this->technical_skills;
    }

    public function setTechnicalSkills(string $technical_skills): self
    {
        $this->technical_skills = $technical_skills;

        return $this;
    }

    public function getProductivity(): ?string
    {
        return $this->productivity;
    }

    public function setProductivity(string $productivity): self
    {
        $this->productivity = $productivity;

        return $this;
    }

    public function getRigour(): ?string
    {
        return $this->rigour;
    }

    public function setRigour(string $rigour): self
    {
        $this->rigour = $rigour;

        return $this;
    }

    public function getAutonomy(): ?string
    {
        return $this->autonomy;
    }

    public function setAutonomy(string $autonomy): self
    {
        $this->autonomy = $autonomy;

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

    public function getReactivity(): ?string
    {
        return $this->reactivity;
    }

    public function setReactivity(string $reactivity): self
    {
        $this->reactivity = $reactivity;

        return $this;
    }

    public function getDisponibility(): ?string
    {
        return $this->disponibility;
    }

    public function setDisponibility(string $disponibility): self
    {
        $this->disponibility = $disponibility;

        return $this;
    }

    public function getInvolvement(): ?string
    {
        return $this->involvement;
    }

    public function setInvolvement(string $involvement): self
    {
        $this->involvement = $involvement;

        return $this;
    }

    public function getProactive(): ?string
    {
        return $this->proactive;
    }

    public function setProactive(string $proactive): self
    {
        $this->proactive = $proactive;

        return $this;
    }

    public function getInitiative(): ?string
    {
        return $this->initiative;
    }

    public function setInitiative(string $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getteamwork(): ?string
    {
        return $this->teamwork;
    }

    public function setteamwork(string $teamwork): self
    {
        $this->teamwork = $teamwork;

        return $this;
    }

    public function getVersality(): ?string
    {
        return $this->versality;
    }

    public function setVersality(string $versality): self
    {
        $this->versality = $versality;

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

    public function getDateCreateInfo(): ?\DateTimeInterface
    {
        return $this->date_create_info;
    }

    public function setDateCreateInfo(\DateTimeInterface $date_create_info): self
    {
        $this->date_create_info = $date_create_info;

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
