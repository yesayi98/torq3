<?php


namespace Torq\Core\Components;


use Torq\Core\Components\Traits\Getter;

class Module
{
 use Getter;

    /**
     * @var \ReflectionClass
     */
    protected $reflect;

 public function __construct()
 {
     $this->reflect = new \ReflectionClass(get_called_class());
 }
}