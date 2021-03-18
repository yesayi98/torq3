<?php


namespace Torq\Core\App;

use Torq\Core\Interfaces\Controller;

class Response
{
  public function __construct(Controller $controller)
  {
      dd($controller);
  }
}