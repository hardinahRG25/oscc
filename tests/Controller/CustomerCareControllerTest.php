<?php

namespace App\Test\Controller;

use App\Entity\CustomerCare;
use App\Repository\CustomerCareRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerCareControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CustomerCareRepository $repository;
    private string $path = '/customer/care/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(CustomerCare::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('CustomerCare index');

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
            'customer_care[dateShare]' => 'Testing',
            'customer_care[noteCollaboration]' => 'Testing',
            'customer_care[cust_relationship_info]' => 'Testing',
            'customer_care[cust_relationship_note]' => 'Testing',
            'customer_care[business_info]' => 'Testing',
            'customer_care[business_note]' => 'Testing',
            'customer_care[cust_back_info]' => 'Testing',
            'customer_care[cust_back_note]' => 'Testing',
            'customer_care[employee_back_info]' => 'Testing',
            'customer_care[employee_back_note]' => 'Testing',
            'customer_care[average_note]' => 'Testing',
            'customer_care[average_score]' => 'Testing',
            'customer_care[createdAt]' => 'Testing',
            'customer_care[updatedAt]' => 'Testing',
            'customer_care[customer]' => 'Testing',
        ]);

        self::assertResponseRedirects('/customer/care/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new CustomerCare();
        $fixture->setDateShare('My Title');
        $fixture->setNoteCollaboration('My Title');
        $fixture->setCust_relationship_info('My Title');
        $fixture->setCust_relationship_note('My Title');
        $fixture->setBusiness_info('My Title');
        $fixture->setBusiness_note('My Title');
        $fixture->setCust_back_info('My Title');
        $fixture->setCust_back_note('My Title');
        $fixture->setEmployee_back_info('My Title');
        $fixture->setEmployee_back_note('My Title');
        $fixture->setAverage_note('My Title');
        $fixture->setAverage_score('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('CustomerCare');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new CustomerCare();
        $fixture->setDateShare('My Title');
        $fixture->setNoteCollaboration('My Title');
        $fixture->setCust_relationship_info('My Title');
        $fixture->setCust_relationship_note('My Title');
        $fixture->setBusiness_info('My Title');
        $fixture->setBusiness_note('My Title');
        $fixture->setCust_back_info('My Title');
        $fixture->setCust_back_note('My Title');
        $fixture->setEmployee_back_info('My Title');
        $fixture->setEmployee_back_note('My Title');
        $fixture->setAverage_note('My Title');
        $fixture->setAverage_score('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'customer_care[dateShare]' => 'Something New',
            'customer_care[noteCollaboration]' => 'Something New',
            'customer_care[cust_relationship_info]' => 'Something New',
            'customer_care[cust_relationship_note]' => 'Something New',
            'customer_care[business_info]' => 'Something New',
            'customer_care[business_note]' => 'Something New',
            'customer_care[cust_back_info]' => 'Something New',
            'customer_care[cust_back_note]' => 'Something New',
            'customer_care[employee_back_info]' => 'Something New',
            'customer_care[employee_back_note]' => 'Something New',
            'customer_care[average_note]' => 'Something New',
            'customer_care[average_score]' => 'Something New',
            'customer_care[createdAt]' => 'Something New',
            'customer_care[updatedAt]' => 'Something New',
            'customer_care[customer]' => 'Something New',
        ]);

        self::assertResponseRedirects('/customer/care/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateShare());
        self::assertSame('Something New', $fixture[0]->getNoteCollaboration());
        self::assertSame('Something New', $fixture[0]->getCust_relationship_info());
        self::assertSame('Something New', $fixture[0]->getCust_relationship_note());
        self::assertSame('Something New', $fixture[0]->getBusiness_info());
        self::assertSame('Something New', $fixture[0]->getBusiness_note());
        self::assertSame('Something New', $fixture[0]->getCust_back_info());
        self::assertSame('Something New', $fixture[0]->getCust_back_note());
        self::assertSame('Something New', $fixture[0]->getEmployee_back_info());
        self::assertSame('Something New', $fixture[0]->getEmployee_back_note());
        self::assertSame('Something New', $fixture[0]->getAverage_note());
        self::assertSame('Something New', $fixture[0]->getAverage_score());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getCustomer());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new CustomerCare();
        $fixture->setDateShare('My Title');
        $fixture->setNoteCollaboration('My Title');
        $fixture->setCust_relationship_info('My Title');
        $fixture->setCust_relationship_note('My Title');
        $fixture->setBusiness_info('My Title');
        $fixture->setBusiness_note('My Title');
        $fixture->setCust_back_info('My Title');
        $fixture->setCust_back_note('My Title');
        $fixture->setEmployee_back_info('My Title');
        $fixture->setEmployee_back_note('My Title');
        $fixture->setAverage_note('My Title');
        $fixture->setAverage_score('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/customer/care/');
    }
}
