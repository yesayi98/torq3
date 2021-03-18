<?php

require __DIR__."/../vendor/autoload.php";

$app = require_once __DIR__.'/../system/app.php';

function Container() {
    global $app;
    return $app->getContainer();
}

$application = $app->make(Torq\Core\Console\Kernel::class, true);

$application->run();