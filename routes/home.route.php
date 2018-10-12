<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/', function(Request $request, Response $response, array $args) {
    try{
        $gmapper = new General($this->db, $this->logger);
        $setting = $gmapper->getSettings();
        $mapper = new Home($this->db, $this->logger);
        $topslides = $mapper->getTopSlides();
        $subslides = $mapper->getsubSlides();
        $response = $this->view->render($response, 'index.phtml', 
            [
                'setting' => $setting,
                'topslides' => $topslides,
                'subslides' => $subslides
            ]
        );
        return $response;
    } catch(PDOException $e) {
        // $this->logger->addInfo($e->getMessage());
        $response->getBody()->write($e->getMessage());
        return $response;
    }
    
});

