<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
$app->get('/admin/categories', function(Request $req, Response $res) {
    try{
        $mapper = new Category($this->db);
        $categories = $mapper->getCategories();
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $categories
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


$app->get('/admin/category/:id', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    try{
        $mapper = new Category($this->db);
        $category = $mapper->getCategory($id);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $category
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

$app->post('/admin/category', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $category = $data['category'];
    $cat = new \stdClass();
    $cat->category = filter_var($category['category'], FILTER_SANITIZE_STRING);
    $cat->description = filter_var($category['description'], FILTER_SANITIZE_STRING);
    $cat->parent_id = filter_var($category['parent_id'], FILTER_SANITIZE_NUMBER_INT);
    $this->logger->addInfo("parent id is $cat->parent_id");
    try{
        $mapper = new Category($this->db);
        $category = $mapper->saveCategory($cat);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $category
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
