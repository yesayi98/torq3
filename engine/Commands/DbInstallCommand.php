<?php


namespace Torq\Commands;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DbInstallCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:install-db';

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = Container()->get('db')->getManager();
        $metas = $em->getMetadataFactory()->getAllMetadata();

        $tool = new SchemaTool($em);

        try {
            $tool->createSchema($metas);
            $output->writeln('<fg=green>DB Installed!</>');
        }catch (\Exception $e){
            $output->writeln('<fg=red>'.$e->getMessage().'</>');
        }
    }
}