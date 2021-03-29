<?php


namespace Torq\Core\App;

use Doctrine\Common\Cache\PhpFileCache;
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
}