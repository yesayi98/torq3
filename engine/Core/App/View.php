<?php


namespace Torq\Core\App;


use Torq\Core\Interfaces\Controller as ControllerInterface;

class View
{
    /**
     * @var mixed
     */
    private $viewDriver;

    protected $request;
    protected $controller;
    protected $display;
    /**
     * @var false|string|string[]
     */
    private $templatePath;

    public function __construct(ControllerInterface $controller)
    {
        $app = Container()->get('application');
        $driver = $app->getAppConfig('view_driver');
        $this->viewDriver = new $driver();

        $this->controller = $controller;
        $this->request = $controller->getRequest();
        $this->viewDriver->setTemplateDir($app->getBasePath().$app->getAppConfig('view_path'))
            ->setCompileDir($app->getAppConfig('cache_dir').'/templates_c')
            ->setCacheDir($app->getAppConfig('cache_dir'));
        $this->setHelpers();
        $this->setTemplatePath();
        $this->viewDriver->assign('controller', $controller);
        $this->viewDriver->assign('module', $controller->getRequest()->attributes->get('_module'));
    }

    public function setTemplatePath(){
        $this->templatePath = mb_strtolower(
            $this->request->attributes->get('_module')->getName().'/'.
            substr($this->controller->getName(), 0, strpos( $this->controller->getName(), 'Controller')).'/'.
            $this->request->attributes->get('_action').'.tpl'
        );
    }

    public function render() {
        try {
            $this->display = $this->viewDriver->fetch($this->templatePath);
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

    public function assign($key, $value = null){
        if (is_array($key)){
            $this->viewDriver->assign($key);
        }else{
            $this->viewDriver->assign($key, $value);
        }
    }
}