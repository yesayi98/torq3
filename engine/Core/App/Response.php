<?php


namespace Torq\Core\App;

use Torq\Core\Interfaces\Controller;

class Response extends \Symfony\Component\HttpFoundation\Response
{
  public function __construct(Controller $controller, $status = 200)
  {
      parent::__construct($controller->view()->getDisplay(), $status, ['content-type' => 'text/html']);
  }
}