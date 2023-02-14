<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\MailerService;

#[AsCommand(
    name: 'app:mail-test',
    description: 'Test email',
)]
class MailTestCommand extends Command
{
    private $mail;

    public function __construct(MailerService $mail)
    {
        parent::__construct();
        $this->mail = $mail;
    }
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::REQUIRED, 'adress email');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $this->mail->sendEmail(to: 'hardinah@novity.io');
        }

        $io->success('Test send email');

        return Command::SUCCESS;
    }
}
