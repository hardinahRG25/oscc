<?php

namespace App\Test\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MissionControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private MissionRepository $repository;
    private string $path = '/mission/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Mission::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Mission index');

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
            'mission[job]' => 'Testing',
            'mission[date_start]' => 'Testing',
            'mission[date_end]' => 'Testing',
            'mission[mission_type]' => 'Testing',
            'mission[reason_contract_end]' => 'Testing',
            'mission[date_create_info]' => 'Testing',
            'mission[status]' => 'Testing',
            'mission[employee]' => 'Testing',
            'mission[customer]' => 'Testing',
        ]);

        self::assertResponseRedirects('/mission/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Mission();
        $fixture->setJob('My Title');
        $fixture->setDate_start('My Title');
        $fixture->setDate_end('My Title');
        $fixture->setMission_type('My Title');
        $fixture->setReason_contract_end('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setStatus('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Mission');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Mission();
        $fixture->setJob('My Title');
        $fixture->setDate_start('My Title');
        $fixture->setDate_end('My Title');
        $fixture->setMission_type('My Title');
        $fixture->setReason_contract_end('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setStatus('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'mission[job]' => 'Something New',
            'mission[date_start]' => 'Something New',
            'mission[date_end]' => 'Something New',
            'mission[mission_type]' => 'Something New',
            'mission[reason_contract_end]' => 'Something New',
            'mission[date_create_info]' => 'Something New',
            'mission[status]' => 'Something New',
            'mission[employee]' => 'Something New',
            'mission[customer]' => 'Something New',
        ]);

        self::assertResponseRedirects('/mission/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getJob());
        self::assertSame('Something New', $fixture[0]->getDate_start());
        self::assertSame('Something New', $fixture[0]->getDate_end());
        self::assertSame('Something New', $fixture[0]->getMission_type());
        self::assertSame('Something New', $fixture[0]->getReason_contract_end());
        self::assertSame('Something New', $fixture[0]->getDate_create_info());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getEmployee());
        self::assertSame('Something New', $fixture[0]->getCustomer());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Mission();
        $fixture->setJob('My Title');
        $fixture->setDate_start('My Title');
        $fixture->setDate_end('My Title');
        $fixture->setMission_type('My Title');
        $fixture->setReason_contract_end('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setStatus('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/mission/');
    }
}
