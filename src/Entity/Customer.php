<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $name_company = null;

    #[ORM\Column(length: 45)]
    private ?string $size_company = null;

    #[ORM\Column(length: 45)]
    private ?string $location = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $team_structure = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $day_off = null;

    #[ORM\Column(length: 75, nullable: true)]
    private ?string $cra = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $work_time = "09h - 18h";

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $annual_closure = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $important_criteria = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(length: 45, nullable: true)]
    private ?string $pc_specification = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_create_info = null;

    #[ORM\Column(length: 255)]
    private ?string $contacts = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateCollaboration = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: MoodEmployee::class)]
    private Collection $moodEmployees;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CustomerCare::class)]
    private Collection $customerCares;

    #[ORM\ManyToOne(inversedBy: 'cusActivity')]
    private ?TypeActivity $typeActivity = null;

    #[ORM\ManyToOne(inversedBy: 'cusSector')]
    private ?BusinessSector $businessSector = null;

    #[ORM\ManyToOne(inversedBy: 'cusUm')]
    private ?User $unitManager = null;

    #[ORM\ManyToOne(inversedBy: 'cusBm')]
    private ?User $businessManager = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $stackTech = [];

    #[ORM\ManyToMany(targetEntity: StackTechLanguage::class, inversedBy: 'listStacks')]
    private Collection $listStack;


    public function __construct()
    {
        $this->date_create_info = new \DateTimeImmutable();
        $this->moodEmployees = new ArrayCollection();
        $this->customerCares = new ArrayCollection();
        $this->listStack = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCompany(): ?string
    {
        return $this->name_company;
    }

    public function setNameCompany(string $name_company): self
    {
        $this->name_company = $name_company;

        return $this;
    }

    public function getSizeCompany(): ?string
    {
        return $this->size_company;
    }

    public function setSizeCompany(string $size_company): self
    {
        $this->size_company = $size_company;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getTeamStructure(): ?string
    {
        return $this->team_structure;
    }

    public function setTeamStructure(string $team_structure): self
    {
        $this->team_structure = $team_structure;

        return $this;
    }

    public function getDayOff(): ?string
    {
        return $this->day_off;
    }

    public function setDayOff(?string $day_off): self
    {
        $this->day_off = $day_off;

        return $this;
    }

    public function getCra(): ?string
    {
        return $this->cra;
    }

    public function setCra(?string $cra): self
    {
        $this->cra = $cra;

        return $this;
    }

    public function getWorkTime(): ?string
    {
        return $this->work_time;
    }

    public function setWorkTime(string $work_time): self
    {
        $this->work_time = $work_time;

        return $this;
    }

    public function getAnnualClosure(): ?string
    {
        return $this->annual_closure;
    }

    public function setAnnualClosure(?string $annual_closure): self
    {
        $this->annual_closure = $annual_closure;

        return $this;
    }

    public function getImportantCriteria(): ?string
    {
        return $this->important_criteria;
    }

    public function setImportantCriteria(?string $important_criteria): self
    {
        $this->important_criteria = $important_criteria;

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

    public function getPcSpecification(): ?string
    {
        return $this->pc_specification;
    }

    public function setPcSpecification(?string $pc_specification): self
    {
        $this->pc_specification = $pc_specification;

        return $this;
    }

    public function getDateCreateInfo(): ?\DateTimeInterface
    {
        return $this->date_create_info;
    }

    public function setDateCreateInfo(?\DateTimeInterface $date_create_info): self
    {
        $this->date_create_info = $date_create_info;

        return $this;
    }
    public function __toString()
    {
        return $this->name_company;
    }

    public function getContacts(): ?string
    {
        return $this->contacts;
    }

    public function setContacts(string $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getDateCollaboration(): ?\DateTimeInterface
    {
        return $this->dateCollaboration;
    }

    public function setDateCollaboration(\DateTimeInterface $dateCollaboration): self
    {
        $this->dateCollaboration = $dateCollaboration;

        return $this;
    }

    /**
     * @return Collection<int, MoodEmployee>
     */
    public function getMoodEmployees(): Collection
    {
        return $this->moodEmployees;
    }

    public function addMoodEmployee(MoodEmployee $moodEmployee): self
    {
        if (!$this->moodEmployees->contains($moodEmployee)) {
            $this->moodEmployees->add($moodEmployee);
            $moodEmployee->setCustomer($this);
        }

        return $this;
    }

    public function removeMoodEmployee(MoodEmployee $moodEmployee): self
    {
        if ($this->moodEmployees->removeElement($moodEmployee)) {
            // set the owning side to null (unless already changed)
            if ($moodEmployee->getCustomer() === $this) {
                $moodEmployee->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomerCare>
     */
    public function getCustomerCares(): Collection
    {
        return $this->customerCares;
    }

    public function addCustomerCare(CustomerCare $customerCare): self
    {
        if (!$this->customerCares->contains($customerCare)) {
            $this->customerCares->add($customerCare);
            $customerCare->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomerCare(CustomerCare $customerCare): self
    {
        if ($this->customerCares->removeElement($customerCare)) {
            // set the owning side to null (unless already changed)
            if ($customerCare->getCustomer() === $this) {
                $customerCare->setCustomer(null);
            }
        }

        return $this;
    }

    public function getTypeActivity(): ?TypeActivity
    {
        return $this->typeActivity;
    }

    public function setTypeActivity(?TypeActivity $typeActivity): self
    {
        $this->typeActivity = $typeActivity;

        return $this;
    }

    public function getBusinessSector(): ?BusinessSector
    {
        return $this->businessSector;
    }

    public function setBusinessSector(?BusinessSector $businessSector): self
    {
        $this->businessSector = $businessSector;

        return $this;
    }

    public function getUnitManager(): ?User
    {
        return $this->unitManager;
    }

    public function setUnitManager(?User $unitManager): self
    {
        $this->unitManager = $unitManager;

        return $this;
    }

    public function getBusinessManager(): ?User
    {
        return $this->businessManager;
    }

    public function setBusinessManager(?User $businessManager): self
    {
        $this->businessManager = $businessManager;

        return $this;
    }

    public function getStackTech(): array
    {
        return $this->stackTech;
    }

    public function setStackTech(?array $stackTech): self
    {
        $this->stackTech = $stackTech;

        return $this;
    }

    /**
     * @return Collection<int, StackTechLanguage>
     */
    public function getListStack(): Collection
    {
        return $this->listStack;
    }

    public function addListStack(StackTechLanguage $listStack): self
    {
        if (!$this->listStack->contains($listStack)) {
            $this->listStack->add($listStack);
        }

        return $this;
    }

    public function removeListStack(StackTechLanguage $listStack): self
    {
        $this->listStack->removeElement($listStack);

        return $this;
    }
}
