<?php


namespace Torq\Core\App;

use Doctrine\Common\Cache\PhpFileCache;
use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\NoopWordInflector;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Proxy\Proxy;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager as ModelManager;
use Doctrine\DBAL\Types\Type;
use Torq\Core\Components\Doctrine\UTCDateTimeType;

class EntityManager
{
    private $application;
    private $entityManager;
    private $schemaTool;

   public function __construct(Application $application){
       $this->application = $application;
       $isDevMode = $application->getAppConfig('debug');
       $proxyDir = $application->getAppConfig('proxy_dir');

       $cache = new PhpFileCache(
           $application->getBasePath().$application->getAppConfig('cache_dir').'/models'
       );

       $modelDirs = $application->getAppConfig('model_dirs');
       $useSimpleAnnotationReader = $application->getAppConfig('use_annotation');

       Type::overrideType('datetime', UTCDateTimeType::class);
       Type::overrideType('datetimetz', UTCDateTimeType::class);

       $config = Setup::createAnnotationMetadataConfiguration($modelDirs, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
       $conn = $application->getDatabaseConfig();
       try {
           $this->entityManager = ModelManager::create($conn, $config);
       }catch(\Exception $exception){
           die($exception->getMessage());
       }

       $this->schemaTool = new SchemaTool($this->entityManager);
   }

   public function getManager(){
       return $this->entityManager;
   }

   public function getSchemaTool(){
       return $this->schemaTool;
   }



    public function serializeEntity($entity)
    {
        if ($entity === null) {
            return [];
        }

        if ($entity instanceof Proxy) {
            /* @var Proxy $entity */
            $entity->__load();
            $className = get_parent_class($entity);
        } else {
            $className = get_class($entity);
        }
        $metadata = $this->entityManager->getClassMetadata($className);
        $data = [];
        $inflector = new Inflector(new NoopWordInflector(), new NoopWordInflector());

        foreach ($metadata->fieldMappings as $field => $mapping) {
            if (!($metadata->reflFields[$field] instanceof \ReflectionProperty)) {
                throw new \InvalidArgumentException(sprintf('Expected an instance of %s', \ReflectionProperty::class));
            }

            $data[$field] = $metadata->reflFields[$field]->getValue($entity);
        }

        foreach ($metadata->associationMappings as $field => $mapping) {
            if (!($metadata->reflFields[$field] instanceof \ReflectionProperty)) {
                throw new \InvalidArgumentException(sprintf('Expected an instance of %s', \ReflectionProperty::class));
            }

            $key = $inflector->tableize($field);
            if ($mapping['isCascadeDetach']) {
                $data[$key] = $metadata->reflFields[$field]->getValue($entity);
                if ($data[$key] !== null) {
                    $data[$key] = $this->serializeEntity($data[$key]);
                }
            } elseif ($mapping['isOwningSide'] && $mapping['type'] & ClassMetadata::TO_ONE) {
                if ($metadata->reflFields[$field]->getValue($entity) !== null) {
                    $data[$key] = $this->entityManager->getUnitOfWork()->getEntityIdentifier(
                        $metadata->reflFields[$field]->getValue($entity)
                    );
                } else {
                    // In some case the relationship may not exist, but we want
                    // to know about it
                    $data[$key] = null;
                }
            }
        }

        return $data;
    }
}