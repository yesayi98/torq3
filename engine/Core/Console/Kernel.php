<?php


namespace Core\Console;

use Core\App\Application;
use Core\App\EntityManager;
use Core\App\Router;
use Core\App\Response;
use Core\App\Request;
use Core\Interfaces\Kernel as KernelInterface;

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

    public function bootstrap()
    {
        // TODO: Implement bootstrap() method.
        $bootstrap = new Bootstrap($this->application);
        $bootstrap->setRouter(new Router($this->application));
        $bootstrap->setModelManager(new EntityManager($this->application));
        $bootstrap->setRequest(Request::createBaseRequest());
        $bootstrap->setView(new Response($this->application));
        $bootstrap->setSession(new \SessionHandler());

        return $bootstrap;
    }
}