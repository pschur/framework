<?php

namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateController extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'make:controller';

    protected function configure()
    {
        $this->setDescription('Creates a new Controller');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        $output->write('Hallo');
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;
    }
}