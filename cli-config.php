<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Slim\Container;

require_once __DIR__ . '/api/index.php';

/** @var Container $container */
$container = $app->getContainer();

ConsoleRunner::run(
    ConsoleRunner::createHelperSet($container[EntityManager::class])
);