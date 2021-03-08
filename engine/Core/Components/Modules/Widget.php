<?php


namespace Core\Components\Modules;


use Core\Interfaces\Module;

class Widget implements Module
{
    protected $paths = [
        'controller' => 'Controllers\\Widgets\\',
    ];

    /**
     * @return string[]
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    public function getPath($path, $default = null){
        return !empty($path)?$path:$default;
    }
}