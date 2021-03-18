<?php


namespace Torq\Core\Interfaces;

interface Model
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return mixed
     */
    public function save();

    /**
     * @return mixed
     */
    public function create();

    /**
     * @return mixed
     */
    public function delete();
}