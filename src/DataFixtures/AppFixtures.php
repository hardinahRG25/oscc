<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Customer;
use App\Service\Generate;
use App\Entity\University;
use App\Entity\TypeActivity;
use App\Entity\BusinessSector;
use App\Entity\StackTechLanguage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
	/**
	 * @author novity <email@email.com>
	 * @var Generator
	 */
	private Generator $faker;
	private $generate;

	public function __construct(Generate $generate)
	{
		$this->generate = $generate;
		$this->faker = Factory::create('fr_FR');
	}

	public function load(ObjectManager $manager): void
	{
		// Users
		$users = [];
		$typeContract = ['SALARIE', 'INDEPENDANT'];
		$maritalStatus = ['Celibataire', 'Marié(e)'];
		$location = ['MADAGASCAR', 'MAURICE'];
		$university = ['ENI', 'ISPM', 'AKANTSO', 'MISA', 'INFOCENTRE', 'CNTEMAD', 'IT', 'AUTODIDACTE'];
		$langage = ['PHP', 'JAVA', 'C', 'C#', 'PYTHON', 'JAVASCRIPT', 'REACT', 'NODEJS'];
		$degree = ['M2 Info', 'M2 MAth', 'Licence informatique', 'M2 Polytech', 'M1'];
		$level = ['DEBUTANT', 'MOYEN', 'AVANCE', 'EXCELLENT'];
		$jobList = ['UM', 'BM', 'COLLABORATEUR'];
		$gender = ['f', 'm'];
		//back office

		$typeActivityList = ['ESN', 'EDITEUR', 'AUTRE'];
		$sectorActivityList = ['FINANCE', 'MOBILIER', 'TECHNOLOGIE', 'JURIDIQUE'];

		//language

		$TechList = ['Python', 'Java', 'JavaScript', 'C#', 'C/C++', 'PHP', 'R', 'TypeScript', 'Go', 'Swift', 'HTML/CSS'];

		$admin = new User();
		$admin->setEmail('admin@novity.io')
			->setRoles(['ROLE_ADMIN'])
			->setPassword('admin123456')
			->setLastname('Admin')
			->setFirstname('Novity')
			->setDateEntry(new DateTime('2022-09-01'))
			->setCountry('Madagascar')
			->setQualification('qualification 1')
			->setContractType($typeContract[mt_rand(0, count($typeContract) - 1)])
			->setBirthDate(new DateTime('1995-06-07'))
			->setMatrimonialStatus($maritalStatus[mt_rand(0, count($maritalStatus) - 1)])
			->setChildNumber(mt_rand(0, 5))
			->setAddress($this->faker->streetAddress)
			->setDistrict($this->faker->locale)
			->setCity($this->faker->city)
			->setChildNumber(mt_rand(0, 5))
			->setGender($gender[mt_rand(0, 1)])
			->setLocation('Antananarivo')
			->setContacts($this->generate->generateNumber('mg'))
			->setTechDominantCv($langage[mt_rand(0, count($langage) - 1)])
			->setTechMaster($langage[mt_rand(0, count($langage) - 1)])
			->setTechActive($langage[mt_rand(0, count($langage) - 1)])
			->setTechOthers('Js, Ndde, React, Angular')
			->setEnglishLevel($level[mt_rand(0, count($level) - 1)])
			->setJob('UM')
			->setOriginalCompany($this->faker->company())
			->setCreatedAt(new \DateTimeImmutable())
			->setUpdatedAt(new \DateTimeImmutable());

		$users[] = $admin;
		$manager->persist($admin);

		for ($i = 1; $i <= 2; $i++) {
			$unitManager = new User();
			$location_name = $location[mt_rand(0, count($location) - 1)];
			$unitManager->setEmail($this->faker->email())
				->setPassword('password123456')
				->setRoles(['ROLE_USER'])
				->setLastname($this->faker->lastName())
				->setFirstname($this->faker->firstName())
				->setDateEntry(new DateTime($this->faker->date()))
				->setCountry('France')
				->setQualification('qualification ' . ($i + 1))
				->setContractType($typeContract[mt_rand(0, count($typeContract) - 1)])
				->setBirthDate(new DateTime($this->faker->date()))
				->setMatrimonialStatus($maritalStatus[mt_rand(0, count($maritalStatus) - 1)])
				->setAddress($this->faker->streetAddress)
				->setDistrict($this->faker->locale)
				->setCity($this->faker->city)
				->setChildNumber(mt_rand(0, 5))
				->setLocation($location_name)
				->setContacts('+261 34 56 234 56')
				->setTechDominantCv($langage[mt_rand(0, count($langage) - 1)])
				->setTechMaster($langage[mt_rand(0, count($langage) - 1)])
				->setTechActive($langage[mt_rand(0, count($langage) - 1)])
				->setTechOthers('Js, Ndde, React, Angular')
				->setEnglishLevel($level[mt_rand(0, count($level) - 1)])
				->setJob('UM')
				->setOriginalCompany($this->faker->company())
				->setGender($gender[mt_rand(0, 1)])
				->setCreatedAt(new \DateTimeImmutable())
				->setUpdatedAt(new \DateTimeImmutable());

			$manager->persist($unitManager);
		}
		for ($i = 0; $i < 3; $i++) {
			$businessManager = new User();
			$location_name = $location[mt_rand(0, count($location) - 1)];
			$businessManager->setEmail($this->faker->email())
				->setPassword('password123456')
				->setRoles(['ROLE_USER'])
				->setLastname($this->faker->lastName())
				->setFirstname($this->faker->firstName())
				->setDateEntry(new DateTime($this->faker->date()))
				->setCountry('France')
				->setQualification('qualification ' . ($i + 1))
				->setContractType($typeContract[mt_rand(0, count($typeContract) - 1)])
				->setBirthDate(new DateTime($this->faker->date()))
				->setMatrimonialStatus($maritalStatus[mt_rand(0, count($maritalStatus) - 1)])
				->setAddress($this->faker->streetAddress)
				->setDistrict($this->faker->locale)
				->setCity($this->faker->city)
				->setChildNumber(mt_rand(0, 5))
				->setLocation($location_name)
				->setContacts('+261 34 56 234 56')
				->setTechDominantCv($langage[mt_rand(0, count($langage) - 1)])
				->setTechMaster($langage[mt_rand(0, count($langage) - 1)])
				->setTechActive($langage[mt_rand(0, count($langage) - 1)])
				->setTechOthers('Js, Ndde, React, Angular')
				->setEnglishLevel($level[mt_rand(0, count($level) - 1)])
				->setJob('BM')
				->setOriginalCompany($this->faker->company())
				->setGender($gender[mt_rand(0, 1)])
				->setCreatedAt(new \DateTimeImmutable())
				->setUpdatedAt(new \DateTimeImmutable());
			$manager->persist($businessManager);
		}

		for ($i = 0; $i < mt_rand(4, 21); $i++) {
			$user = new User();
			$location_name = $location[mt_rand(0, count($location) - 1)];
			$user->setEmail($this->faker->email())
				->setPassword('password123456')
				->setRoles(['ROLE_USER'])
				->setLastname($this->faker->lastName())
				->setFirstname($this->faker->firstName())
				->setDateEntry(new DateTime($this->faker->date()))
				->setCountry('France')
				->setQualification('qualification ' . ($i + 1))
				->setContractType($typeContract[mt_rand(0, count($typeContract) - 1)])
				->setBirthDate(new DateTime($this->faker->date()))
				->setMatrimonialStatus($maritalStatus[mt_rand(0, count($maritalStatus) - 1)])
				->setAddress($this->faker->streetAddress)
				->setDistrict($this->faker->locale)
				->setCity($this->faker->city)
				->setChildNumber(mt_rand(0, 5))
				->setLocation($location_name)
				->setContacts('+26134 56 234 56')
				->setTechDominantCv($langage[mt_rand(0, count($langage) - 1)])
				->setTechMaster($langage[mt_rand(0, count($langage) - 1)])
				->setTechActive($langage[mt_rand(0, count($langage) - 1)])
				->setTechOthers('Js, Ndde, React, Angular')
				->setEnglishLevel($level[mt_rand(0, count($level) - 1)])
				->setJob($jobList[mt_rand(0, count($jobList) - 1)])
				->setOriginalCompany($this->faker->company())
				->setGender($gender[mt_rand(0, 1)])
				->setCreatedAt(new \DateTimeImmutable())
				->setUpdatedAt(new \DateTimeImmutable());

			$users[] = $user;
			$manager->persist($user);
		}

		//Activity


		for ($i = 0; $i < count($typeActivityList); $i++) {
			$activityCustomer = new TypeActivity();
			$activityCustomer->setNameActivity($typeActivityList[$i]);
			$manager->persist($activityCustomer);
		}


		for ($i = 0; $i < count($sectorActivityList); $i++) {
			$sectorCustomer = new BusinessSector();
			$sectorCustomer->setNameSector($sectorActivityList[$i]);
			$manager->persist($sectorCustomer);
		}

		//Stack technic
		for ($i = 0; $i < count($TechList); $i++) {
			$stackTech = new StackTechLanguage();
			$stackTech->setNameLanguage($TechList[$i]);
			$manager->persist($stackTech);
		}

		//university
		$universityArray = ['ISSIG', 'ISPM', 'IT', 'AKATSO', 'IST', 'Hors Mada'];
		for ($i = 0; $i < count($universityArray); $i++) {
			$university = new University();
			$university->setNameUniversity($universityArray[$i]);
			$manager->persist($university);
		}
		//customer
		for ($i = 0; $i < 5; $i++) {
			$customer = new Customer();
			$customer->setAnnualClosure('Fin d année')
				// ->setBusinessManager($businessManager->getId())
				// ->setBusinessSector($sectorCustomer[mt_rand(0, 2)])
				->setContacts($this->faker->companyEmail())
				->setCra('Fin du mois')
				->setDateCollaboration($this->faker->dateTimeBetween('-1 months', '-1 seconds'))
				->setDayOff('10 par an ')
				->setImportantCriteria($this->faker->text(10))
				->setLocation($this->faker->country)
				->setNameCompany($this->faker->company)
				->setNotes($this->faker->text)
				->setPcSpecification($this->faker->text(10))
				->setSizeCompany(mt_rand(10, 20) . ' personnes')
				->setStackTech([])
				->setTeamStructure($this->faker->text(50))
				// ->setTypeActivity($activityCustomer[mt_rand(0, 2)])
				// ->setUnitManager($unitManager[mt_rand(0, 2)])
				->setWorkTime('09h-18h');
			$manager->persist($customer);
		}


		//Save

		$manager->flush();
	}
}
