<?php

namespace App\Test\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CustomerRepository $repository;
    private string $path = '/customer/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Customer::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Customer index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'customer[name_company]' => 'Testing',
            'customer[size_company]' => 'Testing',
            'customer[location]' => 'Testing',
            'customer[team_structure]' => 'Testing',
            'customer[day_off]' => 'Testing',
            'customer[cra]' => 'Testing',
            'customer[work_time]' => 'Testing',
            'customer[annual_closure]' => 'Testing',
            'customer[important_criteria]' => 'Testing',
            'customer[notes]' => 'Testing',
            'customer[pc_specification]' => 'Testing',
            'customer[date_create_info]' => 'Testing',
            'customer[contacts]' => 'Testing',
            'customer[updateAt]' => 'Testing',
            'customer[dateCollaboration]' => 'Testing',
        ]);

        self::assertResponseRedirects('/customer/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Customer();
        $fixture->setName_company('My Title');
        $fixture->setSize_company('My Title');
        $fixture->setLocation('My Title');
        $fixture->setTeam_structure('My Title');
        $fixture->setDay_off('My Title');
        $fixture->setCra('My Title');
        $fixture->setWork_time('My Title');
        $fixture->setAnnual_closure('My Title');
        $fixture->setImportant_criteria('My Title');
        $fixture->setNotes('My Title');
        $fixture->setPc_specification('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setContacts('My Title');
        $fixture->setUpdateAt('My Title');
        $fixture->setDateCollaboration('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Customer');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Customer();
        $fixture->setName_company('My Title');
        $fixture->setSize_company('My Title');
        $fixture->setLocation('My Title');
        $fixture->setTeam_structure('My Title');
        $fixture->setDay_off('My Title');
        $fixture->setCra('My Title');
        $fixture->setWork_time('My Title');
        $fixture->setAnnual_closure('My Title');
        $fixture->setImportant_criteria('My Title');
        $fixture->setNotes('My Title');
        $fixture->setPc_specification('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setContacts('My Title');
        $fixture->setUpdateAt('My Title');
        $fixture->setDateCollaboration('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'customer[name_company]' => 'Something New',
            'customer[size_company]' => 'Something New',
            'customer[location]' => 'Something New',
            'customer[team_structure]' => 'Something New',
            'customer[day_off]' => 'Something New',
            'customer[cra]' => 'Something New',
            'customer[work_time]' => 'Something New',
            'customer[annual_closure]' => 'Something New',
            'customer[important_criteria]' => 'Something New',
            'customer[notes]' => 'Something New',
            'customer[pc_specification]' => 'Something New',
            'customer[date_create_info]' => 'Something New',
            'customer[contacts]' => 'Something New',
            'customer[updateAt]' => 'Something New',
            'customer[dateCollaboration]' => 'Something New',
        ]);

        self::assertResponseRedirects('/customer/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName_company());
        self::assertSame('Something New', $fixture[0]->getSize_company());
        self::assertSame('Something New', $fixture[0]->getLocation());
        self::assertSame('Something New', $fixture[0]->getTeam_structure());
        self::assertSame('Something New', $fixture[0]->getDay_off());
        self::assertSame('Something New', $fixture[0]->getCra());
        self::assertSame('Something New', $fixture[0]->getWork_time());
        self::assertSame('Something New', $fixture[0]->getAnnual_closure());
        self::assertSame('Something New', $fixture[0]->getImportant_criteria());
        self::assertSame('Something New', $fixture[0]->getNotes());
        self::assertSame('Something New', $fixture[0]->getPc_specification());
        self::assertSame('Something New', $fixture[0]->getDate_create_info());
        self::assertSame('Something New', $fixture[0]->getContacts());
        self::assertSame('Something New', $fixture[0]->getUpdateAt());
        self::assertSame('Something New', $fixture[0]->getDateCollaboration());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Customer();
        $fixture->setName_company('My Title');
        $fixture->setSize_company('My Title');
        $fixture->setLocation('My Title');
        $fixture->setTeam_structure('My Title');
        $fixture->setDay_off('My Title');
        $fixture->setCra('My Title');
        $fixture->setWork_time('My Title');
        $fixture->setAnnual_closure('My Title');
        $fixture->setImportant_criteria('My Title');
        $fixture->setNotes('My Title');
        $fixture->setPc_specification('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setContacts('My Title');
        $fixture->setUpdateAt('My Title');
        $fixture->setDateCollaboration('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/customer/');
    }
}
