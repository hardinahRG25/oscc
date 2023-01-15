<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[ORM\EntityListeners(['App\EntityListener\UserListener'])]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'apk_image', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $imageName = null;


    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_entry = null;

    #[ORM\Column(length: 25)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $qualification = null;

    #[ORM\Column(length: 255)]
    private ?string $contract_type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(length: 25)]
    private ?string $matrimonial_status = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    private ?string $contacts = null;


    #[ORM\Column(length: 255)]
    private ?string $tech_dominant_cv = null;

    #[ORM\Column(length: 255)]
    private ?string $tech_master = null;

    #[ORM\Column(length: 125)]
    private ?string $tech_active = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tech_others = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $other_skills = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $skills_evolution = null;

    #[ORM\Column(length: 25)]
    private ?string $english_level = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $original_company = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cv_observations = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $risk_anticipation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $perspective = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column]
    private ?int $childNumber = 0;

    #[ORM\Column(length: 55, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 55, nullable: true)]
    private ?string $district = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $contactSecondary = null;

    #[ORM\OneToMany(mappedBy: 'unitManager', targetEntity: Customer::class)]
    private Collection $cusUm;

    #[ORM\OneToMany(mappedBy: 'businessManager', targetEntity: Customer::class)]
    private Collection $cusBm;

    #[ORM\Column(length: 255)]
    private ?string $job = 'COLLABORATEUR';

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'managerEmployee')]
    private ?self $manager = null;

    #[ORM\OneToMany(mappedBy: 'manager', targetEntity: self::class)]
    private Collection $managerEmployee;

    #[ORM\Column(length: 1)]
    private ?string $gender = null;

    #[ORM\ManyToMany(targetEntity: University::class, inversedBy: 'universityUserHome')]
    private Collection $universityHome;

    #[ORM\OneToMany(mappedBy: 'employee_out', targetEntity: LeaveCompany::class)]
    private Collection $leaveCompanies;

    public function __construct()
    {
        $this->cusUm = new ArrayCollection();
        $this->cusBm = new ArrayCollection();
        $this->managerEmployee = new ArrayCollection();
        $this->universityHome = new ArrayCollection();
        $this->leaveCompanies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function __toString()
    {
        return $this->getFullName();
    }

    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getDateEntry(): ?\DateTimeInterface
    {
        return $this->date_entry;
    }

    public function setDateEntry(\DateTimeInterface $date_entry): self
    {
        $this->date_entry = $date_entry;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getQualification(): ?string
    {
        return $this->qualification;
    }

    public function setQualification(string $qualification): self
    {
        $this->qualification = $qualification;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->contract_type;
    }

    public function setContractType(string $contract_type): self
    {
        $this->contract_type = $contract_type;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getMatrimonialStatus(): ?string
    {
        return $this->matrimonial_status;
    }

    public function setMatrimonialStatus(string $matrimonial_status): self
    {
        $this->matrimonial_status = $matrimonial_status;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getContacts(): ?string
    {
        return $this->contacts;
    }

    public function setContacts(string $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getTechDominantCv(): ?string
    {
        return $this->tech_dominant_cv;
    }

    public function setTechDominantCv(string $tech_dominant_cv): self
    {
        $this->tech_dominant_cv = $tech_dominant_cv;

        return $this;
    }

    public function getTechMaster(): ?string
    {
        return $this->tech_master;
    }

    public function setTechMaster(string $tech_master): self
    {
        $this->tech_master = $tech_master;

        return $this;
    }

    public function getTechActive(): ?string
    {
        return $this->tech_active;
    }

    public function setTechActive(string $tech_active): self
    {
        $this->tech_active = $tech_active;

        return $this;
    }

    public function getTechOthers(): ?string
    {
        return $this->tech_others;
    }

    public function setTechOthers(?string $tech_others): self
    {
        $this->tech_others = $tech_others;

        return $this;
    }

    public function getOtherSkills(): ?string
    {
        return $this->other_skills;
    }

    public function setOtherSkills(?string $other_skills): self
    {
        $this->other_skills = $other_skills;

        return $this;
    }

    public function getSkillsEvolution(): ?string
    {
        return $this->skills_evolution;
    }

    public function setSkillsEvolution(?string $skills_evolution): self
    {
        $this->skills_evolution = $skills_evolution;

        return $this;
    }

    public function getEnglishLevel(): ?string
    {
        return $this->english_level;
    }

    public function setEnglishLevel(string $english_level): self
    {
        $this->english_level = $english_level;

        return $this;
    }

    public function getOriginalCompany(): ?string
    {
        return $this->original_company;
    }

    public function setOriginalCompany(?string $original_company): self
    {
        $this->original_company = $original_company;

        return $this;
    }

    public function getCvObservations(): ?string
    {
        return $this->cv_observations;
    }

    public function setCvObservations(?string $cv_observations): self
    {
        $this->cv_observations = $cv_observations;

        return $this;
    }

    public function getRiskAnticipation(): ?string
    {
        return $this->risk_anticipation;
    }

    public function setRiskAnticipation(?string $risk_anticipation): self
    {
        $this->risk_anticipation = $risk_anticipation;

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

    public function getPerspective(): ?string
    {
        return $this->perspective;
    }

    public function setPerspective(?string $perspective): self
    {
        $this->perspective = $perspective;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function hasRole($role)
    {
        return in_array($role, $this->getRoles());
    }

    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $this->created_at = new \DateTimeImmutable('now');
        $this->updated_at = new \DateTimeImmutable('now');
    }

    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updated_at = new \DateTimeImmutable('now');
    }

    public function getChildNumber(): ?int
    {
        return $this->childNumber;
    }

    public function setChildNumber(int $childNumber): self
    {
        $this->childNumber = $childNumber;

        return $this;
    }



    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getContactSecondary(): ?string
    {
        return $this->contactSecondary;
    }

    public function setContactSecondary(?string $contactSecondary): self
    {
        $this->contactSecondary = $contactSecondary;

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCusUm(): Collection
    {
        return $this->cusUm;
    }

    public function addCusUm(Customer $cusUm): self
    {
        if (!$this->cusUm->contains($cusUm)) {
            $this->cusUm->add($cusUm);
            $cusUm->setUnitManager($this);
        }

        return $this;
    }

    public function removeCusUm(Customer $cusUm): self
    {
        if ($this->cusUm->removeElement($cusUm)) {
            // set the owning side to null (unless already changed)
            if ($cusUm->getUnitManager() === $this) {
                $cusUm->setUnitManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCusBm(): Collection
    {
        return $this->cusBm;
    }

    public function addCusBm(Customer $cusBm): self
    {
        if (!$this->cusBm->contains($cusBm)) {
            $this->cusBm->add($cusBm);
            $cusBm->setBusinessManager($this);
        }

        return $this;
    }

    public function removeCusBm(Customer $cusBm): self
    {
        if ($this->cusBm->removeElement($cusBm)) {
            // set the owning side to null (unless already changed)
            if ($cusBm->getBusinessManager() === $this) {
                $cusBm->setBusinessManager(null);
            }
        }

        return $this;
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

    public function getManager(): ?self
    {
        return $this->manager;
    }

    public function setManager(?self $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getManagerEmployee(): Collection
    {
        return $this->managerEmployee;
    }

    public function addManagerEmployee(self $managerEmployee): self
    {
        if (!$this->managerEmployee->contains($managerEmployee)) {
            $this->managerEmployee->add($managerEmployee);
            $managerEmployee->setManager($this);
        }

        return $this;
    }

    public function removeManagerEmployee(self $managerEmployee): self
    {
        if ($this->managerEmployee->removeElement($managerEmployee)) {
            // set the owning side to null (unless already changed)
            if ($managerEmployee->getManager() === $this) {
                $managerEmployee->setManager(null);
            }
        }

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, University>
     */
    public function getUniversityHome(): Collection
    {
        return $this->universityHome;
    }

    public function addUniversityHome(University $universityHome): self
    {
        if (!$this->universityHome->contains($universityHome)) {
            $this->universityHome->add($universityHome);
        }

        return $this;
    }

    public function removeUniversityHome(University $universityHome): self
    {
        $this->universityHome->removeElement($universityHome);

        return $this;
    }

    /**
     * @return Collection<int, LeaveCompany>
     */
    public function getLeaveCompanies(): Collection
    {
        return $this->leaveCompanies;
    }

    public function addLeaveCompany(LeaveCompany $leaveCompany): self
    {
        if (!$this->leaveCompanies->contains($leaveCompany)) {
            $this->leaveCompanies->add($leaveCompany);
            $leaveCompany->setEmployeeOut($this);
        }

        return $this;
    }

    public function removeLeaveCompany(LeaveCompany $leaveCompany): self
    {
        if ($this->leaveCompanies->removeElement($leaveCompany)) {
            // set the owning side to null (unless already changed)
            if ($leaveCompany->getEmployeeOut() === $this) {
                $leaveCompany->setEmployeeOut(null);
            }
        }

        return $this;
    }
}
