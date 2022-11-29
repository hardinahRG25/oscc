<?php

namespace App\Test\Controller;

use App\Entity\MoodEmployee;
use App\Repository\MoodEmployeeRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MoodEmployeeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private MoodEmployeeRepository $repository;
    private string $path = '/mood/employee/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(MoodEmployee::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('MoodEmployee index');

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
            'mood_employee[dateMood]' => 'Testing',
            'mood_employee[customer_back]' => 'Testing',
            'mood_employee[actions]' => 'Testing',
            'mood_employee[note]' => 'Testing',
            'mood_employee[remark]' => 'Testing',
            'mood_employee[self_notation]' => 'Testing',
            'mood_employee[self_remark]' => 'Testing',
            'mood_employee[novity_note]' => 'Testing',
            'mood_employee[novity_back]' => 'Testing',
            'mood_employee[novity_remark]' => 'Testing',
            'mood_employee[createdAt]' => 'Testing',
            'mood_employee[updatedAt]' => 'Testing',
            'mood_employee[customer]' => 'Testing',
            'mood_employee[employee]' => 'Testing',
        ]);

        self::assertResponseRedirects('/mood/employee/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new MoodEmployee();
        $fixture->setDateMood('My Title');
        $fixture->setCustomer_back('My Title');
        $fixture->setActions('My Title');
        $fixture->setNote('My Title');
        $fixture->setRemark('My Title');
        $fixture->setSelf_notation('My Title');
        $fixture->setSelf_remark('My Title');
        $fixture->setNovity_note('My Title');
        $fixture->setNovity_back('My Title');
        $fixture->setNovity_remark('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCustomer('My Title');
        $fixture->setEmployee('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('MoodEmployee');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new MoodEmployee();
        $fixture->setDateMood('My Title');
        $fixture->setCustomer_back('My Title');
        $fixture->setActions('My Title');
        $fixture->setNote('My Title');
        $fixture->setRemark('My Title');
        $fixture->setSelf_notation('My Title');
        $fixture->setSelf_remark('My Title');
        $fixture->setNovity_note('My Title');
        $fixture->setNovity_back('My Title');
        $fixture->setNovity_remark('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCustomer('My Title');
        $fixture->setEmployee('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'mood_employee[dateMood]' => 'Something New',
            'mood_employee[customer_back]' => 'Something New',
            'mood_employee[actions]' => 'Something New',
            'mood_employee[note]' => 'Something New',
            'mood_employee[remark]' => 'Something New',
            'mood_employee[self_notation]' => 'Something New',
            'mood_employee[self_remark]' => 'Something New',
            'mood_employee[novity_note]' => 'Something New',
            'mood_employee[novity_back]' => 'Something New',
            'mood_employee[novity_remark]' => 'Something New',
            'mood_employee[createdAt]' => 'Something New',
            'mood_employee[updatedAt]' => 'Something New',
            'mood_employee[customer]' => 'Something New',
            'mood_employee[employee]' => 'Something New',
        ]);

        self::assertResponseRedirects('/mood/employee/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateMood());
        self::assertSame('Something New', $fixture[0]->getCustomer_back());
        self::assertSame('Something New', $fixture[0]->getActions());
        self::assertSame('Something New', $fixture[0]->getNote());
        self::assertSame('Something New', $fixture[0]->getRemark());
        self::assertSame('Something New', $fixture[0]->getSelf_notation());
        self::assertSame('Something New', $fixture[0]->getSelf_remark());
        self::assertSame('Something New', $fixture[0]->getNovity_note());
        self::assertSame('Something New', $fixture[0]->getNovity_back());
        self::assertSame('Something New', $fixture[0]->getNovity_remark());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getCustomer());
        self::assertSame('Something New', $fixture[0]->getEmployee());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new MoodEmployee();
        $fixture->setDateMood('My Title');
        $fixture->setCustomer_back('My Title');
        $fixture->setActions('My Title');
        $fixture->setNote('My Title');
        $fixture->setRemark('My Title');
        $fixture->setSelf_notation('My Title');
        $fixture->setSelf_remark('My Title');
        $fixture->setNovity_note('My Title');
        $fixture->setNovity_back('My Title');
        $fixture->setNovity_remark('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCustomer('My Title');
        $fixture->setEmployee('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/mood/employee/');
    }
}
