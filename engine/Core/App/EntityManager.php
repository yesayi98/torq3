<?php


namespace Core\App;

use Doctrine\Common\Cache\PhpFileCache;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager as ModelManager;

class EntityManager
{
    private $application;
    private $entityManager;

   public function __construct(Application $application){
       $this->application = $application;
       $isDevMode = $application->getAppConfig('debug');
       $proxyDir = $application->getAppConfig('proxy_dir');

       $cache = new PhpFileCache(
           $application->getAppConfig('cache_dir')
       );

       $modelDirs = $application->getAppConfig('model_dirs');
       $useSimpleAnnotationReader = $application->getAppConfig('use_annotation');

       $config = Setup::createAnnotationMetadataConfiguration($modelDirs, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
       $conn = $application->getDatabaseConfig();
       try {
           $this->entityManager = ModelManager::create($conn, $config);
       }catch(\Exception $exception){
           die($exception->getMessage());
       }
   }

   public function getManager(){
       return $this->entityManager;
   }
}