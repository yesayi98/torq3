<?php


namespace Torq\Core\App;

use Torq\Core\Interfaces\Controller;

class Response extends \Symfony\Component\HttpFoundation\Response
{
  public function __construct(Controller $controller, $type = 'text/html', $status = 200)
  {
      parent::__construct();
      $this->headers->set('Content-Type', $type);
      $this->setCharset(Container()->get('application')->getAppConfig('charset'));
      $this->setStatusCode($status);
      $this->setContent($controller->view()->getDisplay());
  }

}