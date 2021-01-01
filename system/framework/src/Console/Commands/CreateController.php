<?php

namespace System\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use System\Console\Facades\Console;
use System\Filesystem\File;

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
        $io = Console::style($input, $output);

        $io->text('Create a Controller');

        $main = $io->ask('Controller Name: ', 'HomeController');

        copy(File::path('system/framework/src/Console/stubs/Controller.stub'), File::path('app/Http/Controllers/'.$main.'.php'));

        $io->success('Controller wurde erstellt');

        return Command::SUCCESS;
    }
}