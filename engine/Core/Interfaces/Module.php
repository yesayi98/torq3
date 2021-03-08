<?php


namespace Core\Interfaces;


interface Module
{

    /**
     *
     * @param $path
     * @param $default
     */
    public function getPath($path, $default = null);

    public function getPaths();
}