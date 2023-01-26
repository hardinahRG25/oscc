<?php

namespace App\Command;

use App\Service\Generate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

#[AsCommand(
    name: 'app:oscc-generate',
    description: 'Add a short description for your command',
)]
class OsccGenerateCommand extends Command
{

    private $generate;
    private $translation;

    public function __construct(Generate $generate, TranslatorInterface $translator)
    {
        $this->generate = $generate;
        parent::__construct();
        $this->translation = $translator;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('country',  InputArgument::REQUIRED, 'The country for which you want to generate a phone number')
            ->setDescription('Generate a random phone number by country');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('country');

        if ($arg1) {
            $phone = $this->generate->generateNumber($arg1);
        }

        $io->success('New phone number : ' . $arg1 . ' => ' . $phone);

        return Command::SUCCESS;
    }
}
