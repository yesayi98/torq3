<?php

$app = \Torq\Core\App\Application::getInstance();

$app->set('base_path', dirname(__DIR__));
$app->set('config', require_once __DIR__.'/config_reader.php');
return $app;