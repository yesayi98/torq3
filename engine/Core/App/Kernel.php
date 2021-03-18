<?php


namespace Torq\Core\App;

use Torq\Core\Interfaces\Kernel as KernelInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpKernel;

class Kernel extends HttpKernel implements KernelInterface
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

   public static function bootstrap(): Kernel
   {
       $dispatcher = Container()->get('events');
       // ... add some event listeners

       // create your controller and argument resolvers
       $controllerResolver = Container()->get('controller_resolver');
       $argumentResolver = Container()->get('argument_resolver');
       Container()->get('session')->start();

       // instantiate the kernel
       return new self($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);
   }
}