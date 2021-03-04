<?php


namespace Core;
use Core\App\Application;
use Core\App\Bootstrap;
use Core\App\EntityManager;
use Core\App\Router;
use Core\App\View;
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
       $bootstrap->setRequest(new Request($this->application));
       $bootstrap->setView(new View($this->application));
       $bootstrap->setSession(new \SessionHandler());

       return $bootstrap;
   }
}