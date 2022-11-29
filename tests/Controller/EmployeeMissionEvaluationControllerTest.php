<?php

namespace App\Test\Controller;

use App\Entity\EmployeeMissionEvaluation;
use App\Repository\EmployeeMissionEvaluationRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeeMissionEvaluationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EmployeeMissionEvaluationRepository $repository;
    private string $path = '/employee/mission/evaluation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(EmployeeMissionEvaluation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EmployeeMissionEvaluation index');

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
            'employee_mission_evaluation[technical_skills]' => 'Testing',
            'employee_mission_evaluation[productivity]' => 'Testing',
            'employee_mission_evaluation[rigour]' => 'Testing',
            'employee_mission_evaluation[autonomy]' => 'Testing',
            'employee_mission_evaluation[communication]' => 'Testing',
            'employee_mission_evaluation[reactivity]' => 'Testing',
            'employee_mission_evaluation[disponibility]' => 'Testing',
            'employee_mission_evaluation[involvement]' => 'Testing',
            'employee_mission_evaluation[proactive]' => 'Testing',
            'employee_mission_evaluation[initiative]' => 'Testing',
            'employee_mission_evaluation[teamwork]' => 'Testing',
            'employee_mission_evaluation[versality]' => 'Testing',
            'employee_mission_evaluation[notes]' => 'Testing',
            'employee_mission_evaluation[date_create_info]' => 'Testing',
            'employee_mission_evaluation[examiner]' => 'Testing',
            'employee_mission_evaluation[employee]' => 'Testing',
            'employee_mission_evaluation[customer]' => 'Testing',
        ]);

        self::assertResponseRedirects('/employee/mission/evaluation/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new EmployeeMissionEvaluation();
        $fixture->setTechnical_skills('My Title');
        $fixture->setProductivity('My Title');
        $fixture->setRigour('My Title');
        $fixture->setAutonomy('My Title');
        $fixture->setCommunication('My Title');
        $fixture->setReactivity('My Title');
        $fixture->setDisponibility('My Title');
        $fixture->setInvolvement('My Title');
        $fixture->setProactive('My Title');
        $fixture->setInitiative('My Title');
        $fixture->setTeamwork('My Title');
        $fixture->setVersality('My Title');
        $fixture->setNotes('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setExaminer('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EmployeeMissionEvaluation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new EmployeeMissionEvaluation();
        $fixture->setTechnical_skills('My Title');
        $fixture->setProductivity('My Title');
        $fixture->setRigour('My Title');
        $fixture->setAutonomy('My Title');
        $fixture->setCommunication('My Title');
        $fixture->setReactivity('My Title');
        $fixture->setDisponibility('My Title');
        $fixture->setInvolvement('My Title');
        $fixture->setProactive('My Title');
        $fixture->setInitiative('My Title');
        $fixture->setTeamwork('My Title');
        $fixture->setVersality('My Title');
        $fixture->setNotes('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setExaminer('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'employee_mission_evaluation[technical_skills]' => 'Something New',
            'employee_mission_evaluation[productivity]' => 'Something New',
            'employee_mission_evaluation[rigour]' => 'Something New',
            'employee_mission_evaluation[autonomy]' => 'Something New',
            'employee_mission_evaluation[communication]' => 'Something New',
            'employee_mission_evaluation[reactivity]' => 'Something New',
            'employee_mission_evaluation[disponibility]' => 'Something New',
            'employee_mission_evaluation[involvement]' => 'Something New',
            'employee_mission_evaluation[proactive]' => 'Something New',
            'employee_mission_evaluation[initiative]' => 'Something New',
            'employee_mission_evaluation[teamwork]' => 'Something New',
            'employee_mission_evaluation[versality]' => 'Something New',
            'employee_mission_evaluation[notes]' => 'Something New',
            'employee_mission_evaluation[date_create_info]' => 'Something New',
            'employee_mission_evaluation[examiner]' => 'Something New',
            'employee_mission_evaluation[employee]' => 'Something New',
            'employee_mission_evaluation[customer]' => 'Something New',
        ]);

        self::assertResponseRedirects('/employee/mission/evaluation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTechnical_skills());
        self::assertSame('Something New', $fixture[0]->getProductivity());
        self::assertSame('Something New', $fixture[0]->getRigour());
        self::assertSame('Something New', $fixture[0]->getAutonomy());
        self::assertSame('Something New', $fixture[0]->getCommunication());
        self::assertSame('Something New', $fixture[0]->getReactivity());
        self::assertSame('Something New', $fixture[0]->getDisponibility());
        self::assertSame('Something New', $fixture[0]->getInvolvement());
        self::assertSame('Something New', $fixture[0]->getProactive());
        self::assertSame('Something New', $fixture[0]->getInitiative());
        self::assertSame('Something New', $fixture[0]->getTeamwork());
        self::assertSame('Something New', $fixture[0]->getVersality());
        self::assertSame('Something New', $fixture[0]->getNotes());
        self::assertSame('Something New', $fixture[0]->getDate_create_info());
        self::assertSame('Something New', $fixture[0]->getExaminer());
        self::assertSame('Something New', $fixture[0]->getEmployee());
        self::assertSame('Something New', $fixture[0]->getCustomer());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new EmployeeMissionEvaluation();
        $fixture->setTechnical_skills('My Title');
        $fixture->setProductivity('My Title');
        $fixture->setRigour('My Title');
        $fixture->setAutonomy('My Title');
        $fixture->setCommunication('My Title');
        $fixture->setReactivity('My Title');
        $fixture->setDisponibility('My Title');
        $fixture->setInvolvement('My Title');
        $fixture->setProactive('My Title');
        $fixture->setInitiative('My Title');
        $fixture->setTeamwork('My Title');
        $fixture->setVersality('My Title');
        $fixture->setNotes('My Title');
        $fixture->setDate_create_info('My Title');
        $fixture->setExaminer('My Title');
        $fixture->setEmployee('My Title');
        $fixture->setCustomer('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/employee/mission/evaluation/');
    }
}
