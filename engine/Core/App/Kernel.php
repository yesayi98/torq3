<?php


namespace Core\App;

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
       $bootstrap->setModelManager((new EntityManager($this->application))->getManager());
       $bootstrap->setRequest(Request::createBaseRequest());

       return $bootstrap;
   }
}