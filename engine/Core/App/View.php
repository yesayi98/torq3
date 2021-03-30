<?php


namespace Torq\Core\App;


use Torq\Core\Interfaces\Controller as ControllerInterface;

class View extends \Smarty
{
    protected $request;
    protected $controller;

    public function __construct(ControllerInterface $controller)
    {
        parent::__construct();

        $this->controller = $controller;
        $this->request = $controller->getRequest();
        $this->setHelpers();
        $this->setTemplatePath();
    }

    public function setTemplatePath(){
        $path = mb_strtolower($this->request->attributes->get('_module')->getName().'/'.$this->controller->getName());
    }

    public function setHelpers(){
        $helpers = Container()->get('view_helper')->getRegisteredHelpers();
    }
}