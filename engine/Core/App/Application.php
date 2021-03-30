<?php
namespace Torq\Core\App;


use Torq\Core\Components\Helpers\ViewHelper;
use Torq\Core\Interfaces\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class Application
{
    private $config = null;
    private $base_path = null;
    private $container;
    private static $instance;

    public function set($name, $value){
        $this->{$name} = $value;
    }

    public function get($name){
       return $this->$name;
    }

    public function getAppConfig($config = null){
        if ($config){
            return $this->config['app'][$config];
        }

        return $this->config['app'];
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (!self::$instance){
            self::singleton();
        }

        return self::$instance;
    }

    /**
     * @return null
     */
    public function getBasePath()
    {
        return $this->base_path;
    }

    /**
     * @param null $config
     * @return mixed
     */
    public function getDatabaseConfig($config = null)
    {
        if ($config){
            return $this->config['database'][$config];
        }

        return $this->config['database'];
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param string $kernelClass
     * @param bool $consoleApp
     * @return mixed
     */
    public function make(string $kernelClass, bool $consoleApp = false){

        $request = Request::createBaseRequest();
        $container = new ContainerBuilder();
        $container->register('db', EntityManager::class)->addArgument($this);
        $container->register('router', Router::class)->addArgument($request);
        $container->register('session', Session::class);
        $container->register('view_helper', ViewHelper::class);
        $container->register('events', EventDispatcher::class);
        $container->register('controller_resolver', ControllerResolver::class);
        $container->register('argument_resolver', ArgumentResolver::class);
        $container->set('application', $this);
        // ... add some event listeners

        // create your controller and argument resolvers
        $this->container = $container;

        if (!$consoleApp){
            $router = Container()->get('router');
            $router->run();
            $router->setAttributes();
            $request = $router->getRequest();
        }else{
            return $kernelClass::bootstrap();
        }

        $kernel = $kernelClass::bootstrap();

        $kernel->setApplication($this);

        return $kernel->handle($request);
    }

    public static function singleton(){
        if(!self::$instance){
            self::$instance = new self;
        }
    }
}