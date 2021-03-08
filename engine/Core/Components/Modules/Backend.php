<?php


namespace Core\Components\Modules;


use Core\Interfaces\Module;

class Backend implements Module
{
    protected $paths = [
        'controller' => 'Controllers\\Backend\\',
    ];

    /**
     * @return string[]
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    public function getPath($path, $default = null){
        return !empty($this->paths[$path])?$this->paths[$path]:$default;
    }
}