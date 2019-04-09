<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Doctrine\ORM\EntityManager;
use Woodpile\Entities\Pile;
use Woodpile\Entities\Stack;

// Routes

$app->get('/piles', function (Request $request, Response $response, array $args) {
    /**
     * @var EntityManager $entityManager
     */
    $this->logger->info("Requesting all piles");

    $entityManager = $this->get(EntityManager::class);
    $pileRepository = $entityManager->getRepository(Pile::class);
    $piles = $pileRepository->findAll();

    return $newResponse = $response->withJson($this->serializer->normalize($piles));
});

$app->get('/pile/{pile}', function (Request $request, Response $response, array $args) {
    /**
     * @var EntityManager $entityManager
     */
    $this->logger->info("Requesting pile with id ". $args['pile']);

    $entityManager = $this->get(EntityManager::class);
    $pileRepository = $entityManager->getRepository(Pile::class);
    $pile = $pileRepository->findOneBy(['id' => $args['pile']]);

    return $newResponse = $response->withJson($this->serializer->normalize($pile));
});

$app->get('/stack/{stack}', function (Request $request, Response $response, array $args) {
    $stackId = $args['stack'];

    /**
     * @var EntityManager $entityManager
     */
    $this->logger->info("Requesting stack with id ". $stackId);

    $entityManager = $this->get(EntityManager::class);
    $stackRepository = $entityManager->getRepository(Stack::class);
    $stack = $stackRepository->findOneBy(['id' => $stackId]);

    return $newResponse = $response->withJson($this->serializer->normalize($stack));
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
