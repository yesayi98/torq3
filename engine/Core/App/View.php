<?php


namespace Torq\Core\App;


use Torq\Core\Interfaces\Controller as ControllerInterface;

class View extends \Smarty
{
    protected $request;
    protected $controller;
    protected $display;

    public function __construct(ControllerInterface $controller)
    {
        parent::__construct();
        $app = Container()->get('application');

        $this->controller = $controller;
        $this->request = $controller->getRequest();
        $this->setTemplateDir($app->getBasePath().$app->getAppConfig('view_path'))
            ->setCompileDir($app->getAppConfig('cache_dir').'/templates_c')
            ->setCacheDir($app->getAppConfig('cache_dir'));
        $this->setHelpers();
        $this->setTemplatePath();
        $this->assign('controller', $controller);
        $this->assign('module', $controller->getRequest()->attributes->get('_module'));
    }

    public function setTemplatePath(){
        $templatePath = mb_strtolower(
            $this->request->attributes->get('_module')->getName().'/'.
            substr($this->controller->getName(), 0, strpos( $this->controller->getName(), 'Controller')).'/'.
            $this->request->attributes->get('_action').'.tpl'
        );

        try {
            $this->display($templatePath);
        }catch (\SmartyException $exception){
            dd($exception);
        }
    }

    public function setHelpers(){
        $helpers = Container()->get('view_helper')->getRegisteredHelpers();
    }

    /**
     * @return mixed
     */
    public function getDisplay()
    {
        return $this->display;
    }
}