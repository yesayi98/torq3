<?php


namespace Torq\Core\Components;
use Torq\Core\Interfaces\Model as ModelInterface;

abstract class Model implements ModelInterface
{

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return $this
     */
    public function save()
    {
        $entityManager = Container()->get('db')->getManager();

        if (!$this->getId()){
            return $this->create();
        }

        $entityManager->merge($this);
        $entityManager->flush();

        return $this;
    }

    /**
     * @return $this
     */
    public function create()
    {
        $entityManager = Container()->get('db')->getManager();

        $entityManager->persist($this);
        $entityManager->flush();

        return $this;
    }

    public function delete()
    {
        $entityManager = Container()->get('db')->getManager();
        $entityManager->remove($this);
        $entityManager->flush();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id){
        $entityManager = Container()->get('db')->getManager();

        return $entityManager->getRepository(get_called_class())->find($id);
    }


    public static function __callStatic($method, $arguments)
    {
        $instance = new (get_called_class());

        return $instance->$method(...$arguments);
    }
}