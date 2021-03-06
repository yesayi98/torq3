<?php


namespace Core\App;

use Symfony\Component\HttpFoundation\Request;

class Router
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $route = [
        'module' => 'frontend',
        'controller' => 'index',
        'action' => 'index'
    ];

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request){
        $this->setRequest($request);
    }

    protected function setModule($module){
        $this->route['module'] = $module;
    }

    protected function setController($controller){
        $this->route['controller'] = $controller;
    }

    protected function setAction($action){
        $this->route['action'] = $action;
    }

    /**
     * @param Request $request
     */
    public static function run(Request $request){
        $router = new self($request);

        $routPath = $request->getPathInfo();


        var_dump($routPath);exit;

        return $router;
    }

}