<?php
require __DIR__."/../vendor/autoload.php";

$app = require_once __DIR__.'/../system/app.php';

$bootstrap = $app->make(new \Core\App\Kernel());

$response = $bootstrap->start();

$response->send();