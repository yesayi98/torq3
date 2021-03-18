<?php


namespace Torq\Commands;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DbUpdateCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:update-db';

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = Container()->get('db');
        $metaDataFactory = $em->getManager()->getMetadataFactory();
        $metaDataFactory->getCacheDriver()->deleteAll();
        $output->writeln('<fg=green>Cache cleared!</>');

        $metas = $metaDataFactory->getAllMetaData();

        $tool = $em->getSchemaTool();

        try {
            $tool->updateSchema($metas);
            $output->writeln('<fg=green>DB updated!</>');
        }catch (\Exception $e){
            $output->writeln('<fg=red>'.$e->getMessage().'</>');
        }
    }
}