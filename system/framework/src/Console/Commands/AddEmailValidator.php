<?php

namespace System\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use System\Console\Facades\Console;
use System\Filesystem\File;

class AddEmailValidator extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'add:emailvalidator';

    protected function configure()
    {
        $this->setDescription('Add an EMail Validator');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = Console::style($input, $output);

        shell_exec('composer require egulias/email-validator');

        copy(File::path('system/framework/src/Console/stubs/EmailValidator.stub'), File::path('system/framework/src/Mail/EmailValidator.php'));

        $io->info('Du kannst den Email Validator mit der Klasse System\Mail\EmailValdator::validate("mail@example.com") nutzen.');

        $io->success('Der email validator wurde Erstellt');

        return Command::SUCCESS;
    }
}