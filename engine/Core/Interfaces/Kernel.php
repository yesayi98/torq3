<?php


namespace Core\Interfaces;


use Core\App\Application;

interface Kernel
{
    public function bootstrap();

    public function getApplication();

    public function setApplication(Application $application);
}