<?php
require __DIR__."/../vendor/autoload.php";

$app = require_once __DIR__.'/../system/app.php';

function Container() {
    global $app;
    return $app->getContainer();
}

$response = $app->make(\Torq\Core\App\Kernel::class);

$response->send();