<?php
namespace Core\App;


use Core\Interfaces\Kernel;

class Application
{
    private $config = null;
    private $basePath = null;

    public function set($name, $value){
        $this->{$name} = $value;
    }

    public function get($name){
       return $this->$name;
    }

    public function getAppConfig($config = null){
        if ($config){
            return $this->config['app'][$config];
        }

        return $this->config['app'];
    }

    /**
     * @return null
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param null $config
     * @return mixed
     */
    public function getDatabaseConfig($config = null)
    {
        if ($config){
            return $this->config['database'][$config];
        }

        return $this->config['database'];
    }

    public function make(Kernel $kernel){
        $kernel->setApplication($this);

        return $kernel->bootstrap();
    }
}