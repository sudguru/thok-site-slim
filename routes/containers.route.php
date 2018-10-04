<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/hello/{message}', function(Request $request, Response $response, array $args) {
    $m = $args['message'];
    $response->getBody()->write("hello $m");
    $this->logger->addInfo('Something interesting happened');
    return $response;
});

$app->get('/api/container/{id}', function(Request $req, Response $res, array $args) {
    $id = $args['id'];
    $this->logger->addInfo($id);
    try{
        $mapper = new Container($this->db);
        $container = $mapper->getContainer($id);
        $this->logger->addInfo(json_encode($container));
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $container
        ];
    } catch(PDOException $e) {
        $this->logger->addInfo($e->getMessage());
        $result = [
            'status' => 500,
            'error' => $e->getMessage(),
            'data' => null
        ];
    }
    
    return $res->withJson($result);

});

$app->get('/api/containers', function(Request $req, Response $res) {
    try{
        $mapper = new Container($this->db);
        $containers = $mapper->getContainers();
        $this->logger->addInfo(json_encode($containers));
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $containers
        ];
    } catch(PDOException $e) {
        $this->logger->addInfo($e->getMessage());
        $result = [
            'status' => 500,
            'error' => $e->getMessage(),
            'data' => null
        ];
    }
    
    return $res->withJson($result);

});

$app->post('/api/containers', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $this->logger->addInfo("name: $data[name]");

    $con->name = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $con->unit = filter_var($data['unit'], FILTER_SANITIZE_STRING);
    $con->capacity = filter_var($data['capacity'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $con->initial_quantity = filter_var($data['initial_quantity'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    

    try{
        $mapper = new Container($this->db);
        $containers = $mapper->addContainer($con);
        $this->logger->addInfo(json_encode($containers));
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $containers
        ];
    } catch(PDOException $e) {
        $this->logger->addInfo($e->getMessage());
        $result = [
            'status' => 500,
            'error' => $e->getMessage(),
            'data' => null
        ];
    }
    
    return $res->withJson($result);

});

$app->delete('/api/container/{id}', function(Request $req, Response $res, array $args) {
    $id = $args['id'];
    try{
        $mapper = new Container($this->db);
        $deletedContainer = $mapper->deleteContainer($id);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $deletedContainer
        ];
    } catch(PDOException $e) {
        $this->logger->addInfo($e->getMessage());
        $result = [
            'status' => 500,
            'error' => $e->getMessage(),
            'data' => null
        ];
    }
     return $res->withJson($result);
});