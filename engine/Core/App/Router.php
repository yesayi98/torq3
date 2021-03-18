<?php


namespace Torq\Core\App;

use Torq\Core\Components\UrlParser;
use Torq\Core\Interfaces\Controller;
use Torq\Core\Interfaces\Module;
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

    protected $modules = [
      'frontend',
      'widgets',
      'backend'
    ];

    /**
     * @var Module
     */
    protected $module;

    /**
     * @var Controller
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;

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

    protected function setAction($action){
        $this->action = $action;
    }


    /**
     * @return array|string[]
     */
    public function getRoute(){
        return $this->route;
    }

    public function run(){

        $routPath = $this->request->getPathInfo();

        $parsedUrl = new UrlParser($routPath);

        $moduleName = $parsedUrl->getChunk(0, $this->getRoute()['module']);
        if (!in_array($moduleName, $this->modules)){
            $moduleName = $this->getRoute()['module'];
        }else{
            $parsedUrl->removeChunk(0);
        }

        $this->setModule($moduleName);

        $controllerName = $parsedUrl->getChunk(0, $this->getRoute()['controller']);
        $this->setController($controllerName);

        $this->setAction($parsedUrl->getChunk(1, $this->getRoute()['action']));
        try {
            forward_static_call(array($this->controller, 'endpoint'), $this->action);
        }catch (\Exception $exception){
            die('Action not exist');
        }
        $parameters = forward_static_call(array($this->controller, 'getParam'), $this->action, 'parameter');
        if (!empty($parameters)){
            foreach ($parameters as $parameter) {
                list($param, $value) = explode('|', $parameter);
                $this->request->query->set($param, $parsedUrl->getChunk((int) $value));
            }
        }
    }

    /**
     * @param $moduleName
     */
    protected function setModule($moduleName){
        $modulePath = '\\Torq\\Core\\Components\\Modules\\'.ucfirst($moduleName);
        $this->module = new $modulePath;
    }

    protected function setController($controllerName){
        $controllerPath = $this->module->getPath('controller').ucfirst($controllerName).'Controller';

        if (class_exists ($controllerPath)){
            $this->controller = $controllerPath;
        }else{
            $this->controller = \Torq\Controllers\Frontend\ErrorController::class;
        }
    }

    public function setAttributes(){
        $this->request->attributes->set('_module', $this->module);
        $this->request->attributes->set('_controller', $this->controller);
        $this->request->attributes->set('_action', $this->action);
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

}