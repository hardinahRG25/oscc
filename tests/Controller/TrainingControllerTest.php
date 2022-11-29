<?php

namespace App\Test\Controller;

use App\Entity\Training;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrainingControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private TrainingRepository $repository;
    private string $path = '/training/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Training::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Training index');

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
            'training[objective]' => 'Testing',
            'training[training]' => 'Testing',
            'training[description]' => 'Testing',
            'training[source]' => 'Testing',
            'training[progress]' => 'Testing',
            'training[note]' => 'Testing',
            'training[date_create_info]' => 'Testing',
            'training[employee]' => 'Testing',
        ]);

        self::assertResponseRedirects('/training/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Training();
        $fixture->setObjective('My Title');
        $fixture->setTraining('My Title');
        $fixture->setDescription('My Title');
        $fixture->setSource('My Title');
        $fixture->setProgress('My Title');
        $fixture->setNote('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setEmployee('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Training');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Training();
        $fixture->setObjective('My Title');
        $fixture->setTraining('My Title');
        $fixture->setDescription('My Title');
        $fixture->setSource('My Title');
        $fixture->setProgress('My Title');
        $fixture->setNote('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setEmployee('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'training[objective]' => 'Something New',
            'training[training]' => 'Something New',
            'training[description]' => 'Something New',
            'training[source]' => 'Something New',
            'training[progress]' => 'Something New',
            'training[note]' => 'Something New',
            'training[date_create_info]' => 'Something New',
            'training[employee]' => 'Something New',
        ]);

        self::assertResponseRedirects('/training/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getObjective());
        self::assertSame('Something New', $fixture[0]->getTraining());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getSource());
        self::assertSame('Something New', $fixture[0]->getProgress());
        self::assertSame('Something New', $fixture[0]->getNote());
        self::assertSame('Something New', $fixture[0]->getDate_create_info());
        self::assertSame('Something New', $fixture[0]->getEmployee());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Training();
        $fixture->setObjective('My Title');
        $fixture->setTraining('My Title');
        $fixture->setDescription('My Title');
        $fixture->setSource('My Title');
        $fixture->setProgress('My Title');
        $fixture->setNote('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setEmployee('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/training/');
    }
}
