<?php


namespace Core\Components;


abstract class Model
{
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}