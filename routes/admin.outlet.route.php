<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/admin/outlets', function(Request $req, Response $res) {
    try{
        $mapper = new Outlet($this->db, $this->logger);
        $outlets = $mapper->getOutlets();
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $outlets
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


$app->get('/admin/outlet/:id', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    try{
        $mapper = new Outlet($this->db, $this->logger);
        $outlet = $mapper->getOutlet($id);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $outlet
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

$app->post('/admin/outlet', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $outlet = $data['outlet'];
    $out = new \stdClass();
    $out->outlet = filter_var($outlet['outlet'], FILTER_SANITIZE_STRING);
    $out->description = $outlet['description'];
    $out->contact_person = filter_var($outlet['contact_person'], FILTER_SANITIZE_STRING);
    $out->address = filter_var($outlet['address'], FILTER_SANITIZE_STRING);
    $out->phone = filter_var($outlet['phone'], FILTER_SANITIZE_STRING);
    $out->email = filter_var($outlet['email'], FILTER_SANITIZE_STRING);
    $out->viber = filter_var($outlet['viber'], FILTER_SANITIZE_STRING);
    $out->whatsapp = filter_var($outlet['whatsapp'], FILTER_SANITIZE_STRING);
    $out->skype = filter_var($outlet['skype'], FILTER_SANITIZE_STRING);
    $out->lat = filter_var($outlet['lat'], FILTER_SANITIZE_STRING);
    $out->lng = filter_var($outlet['lng'], FILTER_SANITIZE_STRING);
    if ( get_magic_quotes_gpc() )
        $out->description = htmlspecialchars( stripslashes( $out->description ) ) ;
    else
        $out->description = htmlspecialchars( $out->description );
    
    try{
        $mapper = new Outlet($this->db, $this->logger);
        $outlet = $mapper->saveOutlet($out);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $outlet
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

$app->put('/admin/outlet', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $outlet = $data['outlet'];
    $out = new \stdClass();
    $out->id = filter_var($outlet['id'], FILTER_SANITIZE_NUMBER_INT);
    $out->outlet = filter_var($outlet['outlet'], FILTER_SANITIZE_STRING);
    $out->description = $outlet['description'];
    $out->contact_person = filter_var($outlet['contact_person'], FILTER_SANITIZE_STRING);
    $out->address = filter_var($outlet['address'], FILTER_SANITIZE_STRING);
    $out->phone = filter_var($outlet['phone'], FILTER_SANITIZE_STRING);
    $out->email = filter_var($outlet['email'], FILTER_SANITIZE_STRING);
    $out->viber = filter_var($outlet['viber'], FILTER_SANITIZE_STRING);
    $out->whatsapp = filter_var($outlet['whatsapp'], FILTER_SANITIZE_STRING);
    $out->skype = filter_var($outlet['skype'], FILTER_SANITIZE_STRING);
    $out->lat = filter_var($outlet['lat'], FILTER_SANITIZE_STRING);
    $out->lng = filter_var($outlet['lng'], FILTER_SANITIZE_STRING);
    if ( get_magic_quotes_gpc() )
        $out->description = htmlspecialchars( stripslashes( $out->description ) ) ;
    else
        $out->description = htmlspecialchars( $out->description );

    try{
        $mapper = new Outlet($this->db, $this->logger);
        $no_of_updated_record = $mapper->updateOutlet($out);
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

$app->delete('/admin/outlet/{id}', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    $this->logger->addInfo('id' . $id);
    try{
        $mapper = new Outlet($this->db, $this->logger);
        $no_of_deleted_record = $mapper->deleteOutlet($id);
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
