<?php

use Nip\Container\Container;

define('PROJECT_BASE_PATH', __DIR__.'/..');
define('TEST_BASE_PATH', __DIR__);
define('TEST_FIXTURE_PATH', __DIR__.DIRECTORY_SEPARATOR.'fixtures');

$container = new Container();
Container::setInstance($container);

$data = [
    'audit' => require PROJECT_BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'audit.php'
];
$container->set('config', new \Nip\Config\Config($data));

require dirname(__DIR__) . '/vendor/autoload.php';