<?php


namespace Torq\Core\App;


use Torq\Core\Interfaces\Controller as ControllerInterface;

class View extends \Smarty
{
    protected $request;

    public function __construct(ControllerInterface $controller)
    {
        parent::__construct();

        $this->request = $controller->getRequest();
        $this->setHelpers();
        $this->setTemplatePath();
    }

    public function setTemplatePath(){
        $path = $this->request->attributes->get('_module')->getName();
    }

    public function setHelpers(){
        $helpers = Container()->get('view_helper')->getRegisteredHelpers();
    }
}