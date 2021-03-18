<?php


namespace Torq\Core\Interfaces;


use Torq\Core\App\Application;

interface Kernel
{
    public static function bootstrap();

    public function getApplication();

    public function setApplication(Application $application);
}