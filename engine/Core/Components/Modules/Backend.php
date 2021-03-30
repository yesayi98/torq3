<?php


namespace Torq\Core\Components\Modules;


use Torq\Core\Components\Module;
use Torq\Core\Interfaces\Module as ModuleInterface;

class Backend extends Module implements ModuleInterface
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