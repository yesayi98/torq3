<?php
require __DIR__."/../vendor/autoload.php";

$app = require_once __DIR__.'/../system/app.php';

$kernel = $app->make(new \Core\App\Kernel());

$kernel->start();