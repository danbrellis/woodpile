<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Slim\Container;

require_once __DIR__ . '/public/index.php';

/** @var Container $container */
$container = $app->getContainer();

ConsoleRunner::run(
    ConsoleRunner::createHelperSet($container[EntityManager::class])
);