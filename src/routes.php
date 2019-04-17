<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Doctrine\ORM\EntityManager;
use Woodpile\Entities\Pile;
use Woodpile\Entities\Stack;

// Routes
$app->group('/api', function (App $app) {
    $app->get('/piles', function (Request $request, Response $response, array $args) {
        /**
         * @var EntityManager $entityManager
         * @var Pile $pile
         */
        $this->logger->info("Requesting all piles");

        $entityManager = $this->get(EntityManager::class);
        $pileRepository = $entityManager->getRepository(Pile::class);
        $piles = $pileRepository->findAll();
        $pilesIdd = [];
        foreach($piles as $key => $pile) {
            $pilesIdd[$pile->getId()] = $pile;
        }

        return $newResponse = $response->withJson($this->serializer->normalize($pilesIdd));
    });

    $app->get('/pile/{pile}', function (Request $request, Response $response, array $args) {
        /**
         * @var EntityManager $entityManager
         */
        $this->logger->info("Requesting pile with id " . $args['pile']);

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
        $this->logger->info("Requesting stack with id " . $stackId);

        $entityManager = $this->get(EntityManager::class);
        $stackRepository = $entityManager->getRepository(Stack::class);
        $stack = $stackRepository->findOneBy(['id' => $stackId]);

        return $newResponse = $response->withJson($this->serializer->normalize($stack));
    });

    $app->post('/stack', function (Request $request, Response $response, array $args) {

        /**
         * @var EntityManager $entityManager
         * @var Pile $pile
         */
        $this->logger->info("Requesting to create a new stack");
        $data = $request->getParsedBody();

        $entityManager = $this->get(EntityManager::class);
        $pileRepository = $entityManager->getRepository(Pile::class);

        $pile = $pileRepository->findOneBy(['id' => $data['pileId']]);

        //if no pile, return error
        if(!$pile){
            $this->logger->warn("Attempting to add a new stack to non-existent pile (requested pile " . $data['pileId'] . ")");
            return $response->withStatus(401)->withJson(["status"=>"error", "message" => "Unable find pile.", "error" => "Pile does not exist with ID: " . $data['pileId']]);
        }

        $stack = new Stack();
        $stack->setSpecies($data['species']);
        if($data['dateFelled']){
            $dateFelled = new DateTime($data['dateFelled']);
            $stack->setDateFelled($dateFelled);
        }
        if($data['dateStacked']){
            $dateStacked = new DateTime($data['dateStacked']);
            $stack->setDateStacked($dateStacked);
        }
        $stack->setWidth($data['width']);
        $stack->setHeight($data['height']);
        $stack->setDepth($data['depth']);
        $stack->setIsSplit($data['isSplit'] === 'true' ? true : false);
        $stack->setIsBurnable($data['isBurnable']);
        $stack->setPile($pile);

        $entityManager->persist($stack);

        try {
            $entityManager->flush();
            $this->logger->info("Saved new stack with ID: " . $stack->getId());
            return $response->withStatus(200)->withJson([
                "status" => "success",
                "message" => "Stack successfully added!",
                "stack" => $this->serializer->normalize($stack)
            ]);

        } catch(\Doctrine\ORM\ORMException $e){
            $this->logger->error("Failed saving new stack to pile (ID: " . $data['pileId'] . ")");
            $this->logger->error($e->getCode());
            $this->logger->error($e->getLine());
            $this->logger->error($e->getMessage());
            return $response->withStatus(401)->withJson(["status"=>"error", "message" => "Unable to save stack.", "error" => $e->getMessage()]);
        }
    });

    /*
    $app->get('/[{name}]', function (Request $request, Response $response, array $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/' route");

        // Render index view
        return $this->renderer->render($response, 'index.phtml', $args);
    });
    */
});