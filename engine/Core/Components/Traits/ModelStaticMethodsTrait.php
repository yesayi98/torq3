<?php


namespace Torq\Core\Components\Traits;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;

trait ModelStaticMethodsTrait
{

    protected static $queryBuilder;

    public static function getEntityManager(){
        return Container()->get('db')->getManager();
    }

    public static function __callStatic($name, $arguments)
    {
        $entityManager = self::getEntityManager();
        if (method_exists($entityManager->getRepository(get_called_class()), $name)){
            return self::getEntityManager()->getRepository(get_called_class())->$name(...$arguments);
        }

        return self::getQuery($name, $arguments);
    }

    public static function getQuery($name, $arguments){
        $entityManager = self::getEntityManager();
        $metadata = $entityManager->getClassMetadata(get_called_class());
        $tableName = $metadata->getTableName();

        if (!self::$queryBuilder) {
            self::$queryBuilder = $entityManager->createQueryBuilder();
            self::$queryBuilder->select($tableName);
            self::$queryBuilder->from(get_called_class(), $tableName);
        }
        $parameters = [];
        if (is_array($arguments[0])){
            $arguments = $arguments[0];
            foreach ($arguments as $argument) {
                $parameterPrefix = is_numeric($argument[array_key_last($argument)])?'?':':';
                if (is_array($argument[array_key_last($argument)])){
                    $argument[0] = '('.$argument[0].')';
                }
                $queryString = $tableName.'.'.$argument[0].' '.($argument[2]?$argument[1]:' =').' '.$parameterPrefix.$argument[0];
                self::$queryBuilder->add($name, $queryString);
                $parameters[] = new Parameter($argument[0], $argument[array_key_last($argument)]);
            }

        }else{
            $parameterPrefix = is_numeric($arguments[array_key_last($arguments)])?'?':':';
            $condition = $parameterPrefix.$arguments[0];
            if (is_array($arguments[array_key_last($arguments)])){
                $condition = '('.$condition.')';
            }
            $queryString = $tableName.'.'.$arguments[0].' '.($arguments[2]?$arguments[1]:' =').' '.$condition;
            self::$queryBuilder->add($name, $queryString);
            $parameters[] = new Parameter($arguments[0], $arguments[array_key_last($arguments)]);
        }

        self::$queryBuilder->setParameters(new ArrayCollection($parameters));

        return self::$queryBuilder;
    }
}