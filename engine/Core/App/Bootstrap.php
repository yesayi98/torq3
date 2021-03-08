<?php

namespace Core\App;

use Core\Interfaces\Bootstrap as BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    protected $request;
    protected $modelManager;
    protected $router;
    protected $application;
    protected $response;
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
    public function setResponse($response): void
    {
        $this->view = $response;
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
    public function getResponse()
    {
        return $this->response;
    }

    public function start(){
        date_default_timezone_set($this->application->getAppConfig('timezone'));

        try {
            $route = new Router($this->request);
            $route->run();
            var_dump($route);exit;
        }catch (\Exception $exception){
            die($exception->getMessage());
        }

    }
}