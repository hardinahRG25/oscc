<?php

namespace App\Entity;

use App\Repository\LeaveCompanyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeaveCompanyRepository::class)]
class LeaveCompany
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_resignation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $reason_resignation = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'leaveCompanies')]
    private ?User $employee_out = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateResignation(): ?\DateTimeInterface
    {
        return $this->date_resignation;
    }

    public function setDateResignation(\DateTimeInterface $date_resignation): self
    {
        $this->date_resignation = $date_resignation;

        return $this;
    }

    public function getReasonResignation(): ?string
    {
        return $this->reason_resignation;
    }

    public function setReasonResignation(string $reason_resignation): self
    {
        $this->reason_resignation = $reason_resignation;

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

    public function getEmployeeOut(): ?User
    {
        return $this->employee_out;
    }

    public function setEmployeeOut(?User $employee_out): self
    {
        $this->employee_out = $employee_out;

        return $this;
    }
}
