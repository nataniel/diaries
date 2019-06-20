<?php
chdir(dirname(__DIR__));

// Your application namespace
define('APPLICATION', 'Main');

// Discover environment
$environment = null;
if (preg_match('/^\/(\w+)\/index.php$/', $_SERVER['SCRIPT_NAME'], $regs)) {
    $environment = $regs[1];
}

// Bootstrap E4u\Application
require_once 'vendor/autoload.php';
$app = E4u\Loader::get(APPLICATION);
$app->run()->send();