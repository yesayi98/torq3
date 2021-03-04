<?php


namespace Core\App;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager as ModelManager;

class EntityManager
{
    private $application;

   public function __construct(Application $application){
       $isDevMode = $application->getAppConfig('debug');
       $proxyDir = $application->getAppConfig('proxy_dir');
       $cache = $application->getAppConfig('cache_dir');
       $modelDirs = $application->getAppConfig('model_dirs');
       $useSimpleAnnotationReader = $application->getAppConfig('use_annotation');

       $config = Setup::createAnnotationMetadataConfiguration($modelDirs, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
       $conn = $application->getDatabaseConfig();
       return $entityManager = ModelManager::create($conn, $config);
   }
}