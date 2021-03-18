<?php


namespace Torq\Core\Components\Modules;


use Torq\Core\Interfaces\Module;

class Backend implements Module
{
    protected $paths = [
        'controller' => 'Torq\\Controllers\\Backend\\',
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