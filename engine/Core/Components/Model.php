<?php


namespace Torq\Core\Components;
use Torq\Core\Interfaces\Model as ModelInterface;
use Torq\Core\Components\Traits\TimeStamp;
use Torq\Core\Components\Traits\ModelStaticMethodsTrait;

abstract class Model implements ModelInterface
{

    use TimeStamp, ModelStaticMethodsTrait;

    public function __construct()
    {
        $this->setUpdatedAt();
        $this->setCreatedAt();
    }

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
        $this->setUpdatedAt();

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

    public function get($attribute){
        return $this->$attribute;
    }

    /**
     * @param array|string $attribute
     * @param null|mixed $value
     * @return $this
     */
    public function set($attribute, $value = null){
        if (!is_array($attribute)){
            $this->$attribute = $value;
        }else{
            foreach ($attribute as $key => $item) {
                $this->key = $item;
            }
        }

        return $this;
    }

    public function getRepository(){
        return self::getEntityManager()->getRepository(get_called_class());
    }
}