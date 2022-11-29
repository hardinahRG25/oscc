<?php

namespace App\Entity;

use App\Repository\MoodEmployeeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoodEmployeeRepository::class)]
class MoodEmployee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateMood = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $customer_back = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $actions = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $note = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remark = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $self_notation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $self_remark = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $novity_note = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $novity_back = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $novity_remark = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'moodEmployees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'moodEmployees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employee = null;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->dateMood = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMood(): ?\DateTimeImmutable
    {
        return $this->dateMood;
    }

    public function setDateMood(\DateTimeImmutable $dateMood): self
    {
        $this->dateMood = $dateMood;

        return $this;
    }

    public function getCustomerBack(): ?string
    {
        return $this->customer_back;
    }

    public function setCustomerBack(string $customer_back): self
    {
        $this->customer_back = $customer_back;

        return $this;
    }

    public function getActions(): ?string
    {
        return $this->actions;
    }

    public function setActions(?string $actions): self
    {
        $this->actions = $actions;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getRemark(): ?string
    {
        return $this->remark;
    }

    public function setRemark(?string $remark): self
    {
        $this->remark = $remark;

        return $this;
    }

    public function getSelfNotation(): ?string
    {
        return $this->self_notation;
    }

    public function setSelfNotation(?string $self_notation): self
    {
        $this->self_notation = $self_notation;

        return $this;
    }

    public function getSelfRemark(): ?string
    {
        return $this->self_remark;
    }

    public function setSelfRemark(?string $self_remark): self
    {
        $this->self_remark = $self_remark;

        return $this;
    }

    public function getNovityNote(): ?string
    {
        return $this->novity_note;
    }

    public function setNovityNote(string $novity_note): self
    {
        $this->novity_note = $novity_note;

        return $this;
    }

    public function getNovityBack(): ?string
    {
        return $this->novity_back;
    }

    public function setNovityBack(?string $novity_back): self
    {
        $this->novity_back = $novity_back;

        return $this;
    }

    public function getNovityRemark(): ?string
    {
        return $this->novity_remark;
    }

    public function setNovityRemark(?string $novity_remark): self
    {
        $this->novity_remark = $novity_remark;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

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

    public function getEmployee(): ?User
    {
        return $this->employee;
    }

    public function setEmployee(?User $employee): self
    {
        $this->employee = $employee;

        return $this;
    }
}
