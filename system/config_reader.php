<?php

$base_path = dirname(__DIR__).'/';
$userConfig = require_once $base_path.'config.php';
$appConfig = require_once $base_path.'config/app.php';
$databaseConfig = require_once $base_path.'config/database.php';

return [
    'app' => array_merge($appConfig, empty($userConfig['app'])?[]:$userConfig['app']),
    'database' => array_merge($databaseConfig, empty($userConfig['database'])?[]:$userConfig['database']),
];