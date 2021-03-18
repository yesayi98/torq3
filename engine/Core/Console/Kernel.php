<?php


namespace Torq\Core\Console;

use Torq\Core\App\Application;
use Torq\Core\Interfaces\Kernel as KernelInterface;
use Symfony\Component\Console\Application as SymfonyConsoleApplication;
use Symfony\Component\Finder\Finder;

class Kernel implements KernelInterface
{
    protected $application;

    public function getApplication()
    {
        // TODO: Implement getApplication() method.
    }

    public function setApplication(Application $application)
    {
        // TODO: Implement setApplication() method.
        $this->application = $application;
    }

    public static function bootstrap()
    {
        $application = new SymfonyConsoleApplication();

        $finder = new Finder();
        $finder->files()->in('engine/Commands');
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $fileName = pathinfo($file->getFilename())['filename'];
                $className = '\\Torq\\Commands\\'.$fileName;
                $application->add(new $className);
            }
        }


        return $application;
    }
}