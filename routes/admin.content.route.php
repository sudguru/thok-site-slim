<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/admin/contents', function(Request $req, Response $res) {
    try{
        $mapper = new Content($this->db, $this->logger);
        $contents = $mapper->getContents();
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $contents
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


$app->get('/admin/content/:id', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    try{
        $mapper = new Content($this->db, $this->logger);
        $content = $mapper->getContent($id);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $content
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

$app->post('/admin/content', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $content = $data['content'];
    $c = new \stdClass();
    $c->title = filter_var($content['title'], FILTER_SANITIZE_STRING);
    $c->slug = filter_var($content['slug'], FILTER_SANITIZE_STRING);
    $c->content = filter_var($content['content'], FILTER_SANITIZE_STRING);
    $this->logger->addInfo($c->title);
    try{
        $mapper = new Content($this->db, $this->logger);
        $content = $mapper->saveContent($c);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $content
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

$app->put('/admin/content', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $content = $data['content'];
    $c = new \stdClass();
    $c->id = filter_var($content['id'], FILTER_SANITIZE_NUMBER_INT);
    $c->title = filter_var($content['title'], FILTER_SANITIZE_STRING);
    $c->slug = filter_var($content['slug'], FILTER_SANITIZE_STRING);
    // $c->content = filter_var($content['content'], FILTER_SANITIZE_STRING);
    $c->content = $content['content'];
    if ( get_magic_quotes_gpc() )
        $c->content = htmlspecialchars( stripslashes( $c->content ) ) ;
    else
        $c->content = htmlspecialchars( $c->content ) ;

    try{
        $mapper = new Content($this->db, $this->logger);
        $no_of_updated_record = $mapper->updateContent($c);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $no_of_updated_record
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

$app->delete('/admin/content/{id}', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    $this->logger->addInfo('id' . $id);
    try{
        $mapper = new Content($this->db, $this->logger);
        $no_of_deleted_record = $mapper->deleteContent($id);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $no_of_deleted_record
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
