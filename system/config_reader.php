<?php

$base_path = dirname(__DIR__).'/';
$userConfig = require_once $base_path.'config.php';
$appConfig = require_once $base_path.'config/app.php';
$databaseConfig = require_once $base_path.'config/database.php';

return [
    'app' => $userConfig['app'] ? $userConfig['app'] : $appConfig,
    'database' => $userConfig['database'] ? $userConfig['database'] : $databaseConfig,
];