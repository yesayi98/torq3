<?php


namespace Core\Console;

use Core\App\Application;
use Core\Interfaces\Bootstrap as BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    protected $request;
    protected $modelManager;
    protected $router;
    protected $application;
    protected $view;
    protected $session;
    protected $cookies;

    /**
     * @param mixed $modelManager
     */
    public function setModelManager($modelManager): void
    {
        $this->modelManager = $modelManager;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request): void
    {
        $this->request = $request;
    }

    /**
     * @param mixed $router
     */
    public function setRouter($router): void
    {
        $this->router = $router;
    }

    /**
     * @param Application $application
     */
    public function setApplication(Application $application): void
    {
        $this->application = $application;
    }

    public function __construct(Application $application){
        $this->setApplication($application);
    }

    /**
     * @param mixed $view
     */
    public function setView($view): void
    {
        $this->view = $view;
    }

    /**
     * @param mixed $cookies
     */
    public function setCookies($cookies): void
    {
        $this->cookies = $cookies;
    }

    /**
     * @param mixed $session
     */
    public function setSession($session): void
    {
        $this->session = $session;
    }


    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @return mixed
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @return mixed
     */
    public function getModelManager()
    {
        return $this->modelManager;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    public function start(){
        global $argv;
        var_dump($argv);exit;
    }
}