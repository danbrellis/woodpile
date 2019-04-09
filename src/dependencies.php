<?php
// DIC configuration

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Slim\Container;
use Slim\Views\PhpRenderer;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function (Container $c): PhpRenderer {
    $settings = $c->get('settings')['renderer'];
    return new PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function (Container $c): Monolog\Logger {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// doctrine
$container[EntityManager::class] = function (Container $c): EntityManager {
    $config = Setup::createAnnotationMetadataConfiguration(
        $c['settings']['doctrine']['metadata_dirs'],
        $c['settings']['doctrine']['dev_mode']
    );

    $config->setMetadataDriverImpl(
        new AnnotationDriver(
            new AnnotationReader,
            $c['settings']['doctrine']['metadata_dirs']
        )
    );

    $config->setMetadataCacheImpl(
        new FilesystemCache(
            $c['settings']['doctrine']['cache_dir']
        )
    );

    return EntityManager::create(
        $c['settings']['doctrine']['connection'],
        $config
    );
};

// serializer
$container['serializer'] = function (): Serializer {
    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];

    return new Serializer($normalizers, $encoders);
};