<?php

namespace App\Entity;

use App\Repository\CustomerCareRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerCareRepository::class)]
class CustomerCare
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateShare = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $noteCollaboration = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $cust_relationship_info = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $cust_relationship_note = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $business_info = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $business_note = null;

    #[ORM\Column(length: 100)]
    private ?string $cust_back_info = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $cust_back_note = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $employee_back_info = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $employee_back_note = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $average_note = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $average_score = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'customerCares')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateShare(): ?\DateTimeImmutable
    {
        return $this->dateShare;
    }

    public function setDateShare(\DateTimeImmutable $dateShare): self
    {
        $this->dateShare = $dateShare;

        return $this;
    }

    public function getNoteCollaboration(): ?string
    {
        return $this->noteCollaboration;
    }

    public function setNoteCollaboration(?string $noteCollaboration): self
    {
        $this->noteCollaboration = $noteCollaboration;

        return $this;
    }

    public function getCustRelationshipInfo(): ?string
    {
        return $this->cust_relationship_info;
    }

    public function setCustRelationshipInfo(?string $cust_relationship_info): self
    {
        $this->cust_relationship_info = $cust_relationship_info;

        return $this;
    }

    public function getCustRelationshipNote(): ?string
    {
        return $this->cust_relationship_note;
    }

    public function setCustRelationshipNote(?string $cust_relationship_note): self
    {
        $this->cust_relationship_note = $cust_relationship_note;

        return $this;
    }

    public function getBusinessInfo(): ?string
    {
        return $this->business_info;
    }

    public function setBusinessInfo(?string $business_info): self
    {
        $this->business_info = $business_info;

        return $this;
    }

    public function getBusinessNote(): ?string
    {
        return $this->business_note;
    }

    public function setBusinessNote(?string $business_note): self
    {
        $this->business_note = $business_note;

        return $this;
    }

    public function getCustBackInfo(): ?string
    {
        return $this->cust_back_info;
    }

    public function setCustBackInfo(string $cust_back_info): self
    {
        $this->cust_back_info = $cust_back_info;

        return $this;
    }

    public function getCustBackNote(): ?string
    {
        return $this->cust_back_note;
    }

    public function setCustBackNote(?string $cust_back_note): self
    {
        $this->cust_back_note = $cust_back_note;

        return $this;
    }

    public function getEmployeeBackInfo(): ?string
    {
        return $this->employee_back_info;
    }

    public function setEmployeeBackInfo(?string $employee_back_info): self
    {
        $this->employee_back_info = $employee_back_info;

        return $this;
    }

    public function getEmployeeBackNote(): ?string
    {
        return $this->employee_back_note;
    }

    public function setEmployeeBackNote(?string $employee_back_note): self
    {
        $this->employee_back_note = $employee_back_note;

        return $this;
    }

    public function getAverageNote(): ?string
    {
        return $this->average_note;
    }

    public function setAverageNote(?string $average_note): self
    {
        $this->average_note = $average_note;

        return $this;
    }

    public function getAverageScore(): ?string
    {
        return $this->average_score;
    }

    public function setAverageScore(?string $average_score): self
    {
        $this->average_score = $average_score;

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
}
