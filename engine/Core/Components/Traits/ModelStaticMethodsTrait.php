<?php


namespace Torq\Core\Components\Traits;


trait ModelStaticMethodsTrait
{
    public static function getEntityManager(){
        return Container()->get('db')->getManager();
    }

    public static function __callStatic($name, $arguments)
    {
        return self::getEntityManager()->getRepository(get_called_class())->$name(...$arguments);
    }
}