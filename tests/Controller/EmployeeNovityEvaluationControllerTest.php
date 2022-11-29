<?php

namespace App\Test\Controller;

use App\Entity\EmployeeNovityEvaluation;
use App\Repository\EmployeeNovityEvaluationRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeeNovityEvaluationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EmployeeNovityEvaluationRepository $repository;
    private string $path = '/employee/novity/evaluation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(EmployeeNovityEvaluation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EmployeeNovityEvaluation index');

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
            'employee_novity_evaluation[integration]' => 'Testing',
            'employee_novity_evaluation[model]' => 'Testing',
            'employee_novity_evaluation[communication]' => 'Testing',
            'employee_novity_evaluation[professionnal]' => 'Testing',
            'employee_novity_evaluation[excellence]' => 'Testing',
            'employee_novity_evaluation[audacity]' => 'Testing',
            'employee_novity_evaluation[humanity]' => 'Testing',
            'employee_novity_evaluation[examiner]' => 'Testing',
            'employee_novity_evaluation[notes]' => 'Testing',
            'employee_novity_evaluation[date_creation_info]' => 'Testing',
            'employee_novity_evaluation[employee]' => 'Testing',
            'employee_novity_evaluation[customer]' => 'Testing',
        ]);

        self::assertResponseRedirects('/employee/novity/evaluation/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new EmployeeNovityEvaluation();
        $fixture->setIntegration('My Title');
        $fixture->setModel('My Title');
        $fixture->setCommunication('My Title');
        $fixture->setProfessionnal('My Title');
        $fixture->setExcellence('My Title');
        $fixture->setAudacity('My Title');
        $fixture->setHumanity('My Title');
        $fixture->setExaminer('My Title');
        $fixture->setNotes('My Title');
        $fixture->setDate_creation_info('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EmployeeNovityEvaluation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new EmployeeNovityEvaluation();
        $fixture->setIntegration('My Title');
        $fixture->setModel('My Title');
        $fixture->setCommunication('My Title');
        $fixture->setProfessionnal('My Title');
        $fixture->setExcellence('My Title');
        $fixture->setAudacity('My Title');
        $fixture->setHumanity('My Title');
        $fixture->setExaminer('My Title');
        $fixture->setNotes('My Title');
        $fixture->setDate_creation_info('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'employee_novity_evaluation[integration]' => 'Something New',
            'employee_novity_evaluation[model]' => 'Something New',
            'employee_novity_evaluation[communication]' => 'Something New',
            'employee_novity_evaluation[professionnal]' => 'Something New',
            'employee_novity_evaluation[excellence]' => 'Something New',
            'employee_novity_evaluation[audacity]' => 'Something New',
            'employee_novity_evaluation[humanity]' => 'Something New',
            'employee_novity_evaluation[examiner]' => 'Something New',
            'employee_novity_evaluation[notes]' => 'Something New',
            'employee_novity_evaluation[date_creation_info]' => 'Something New',
            'employee_novity_evaluation[employee]' => 'Something New',
            'employee_novity_evaluation[customer]' => 'Something New',
        ]);

        self::assertResponseRedirects('/employee/novity/evaluation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getIntegration());
        self::assertSame('Something New', $fixture[0]->getModel());
        self::assertSame('Something New', $fixture[0]->getCommunication());
        self::assertSame('Something New', $fixture[0]->getProfessionnal());
        self::assertSame('Something New', $fixture[0]->getExcellence());
        self::assertSame('Something New', $fixture[0]->getAudacity());
        self::assertSame('Something New', $fixture[0]->getHumanity());
        self::assertSame('Something New', $fixture[0]->getExaminer());
        self::assertSame('Something New', $fixture[0]->getNotes());
        self::assertSame('Something New', $fixture[0]->getDate_creation_info());
        self::assertSame('Something New', $fixture[0]->getEmployee());
        self::assertSame('Something New', $fixture[0]->getCustomer());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new EmployeeNovityEvaluation();
        $fixture->setIntegration('My Title');
        $fixture->setModel('My Title');
        $fixture->setCommunication('My Title');
        $fixture->setProfessionnal('My Title');
        $fixture->setExcellence('My Title');
        $fixture->setAudacity('My Title');
        $fixture->setHumanity('My Title');
        $fixture->setExaminer('My Title');
        $fixture->setNotes('My Title');
        $fixture->setDate_creation_info('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/employee/novity/evaluation/');
    }
}
