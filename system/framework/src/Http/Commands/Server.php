<?php

namespace System\Http\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use System\Console\Facades\Console;

class Server extends Command
{
    protected static $defaultName = 'server';

    protected function configure()
    {
        $this->setDescription('starts a Development Server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = Console::style($input, $output);

        $io->text("Starting Server \n Exit with Strg + C");

        shell_exec('php -S localhost:8000 -t '.ROOT.'/public/');

        return Command::SUCCESS;
    }
}