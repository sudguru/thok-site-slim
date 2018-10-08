<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/admin/paymentmethods', function(Request $req, Response $res) {
    try{
        $mapper = new Paymentmethod($this->db, $this->logger);
        $paymentmethods = $mapper->getPaymentmethods();
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $paymentmethods
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


$app->get('/admin/paymentmethod/:id', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    try{
        $mapper = new Paymentmethod($this->db, $this->logger);
        $payment = $mapper->getPaymentmethod($id);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $payment
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

$app->post('/admin/paymentmethod', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $paymentmethod = $data['paymentmethod'];
    $pm = new \stdClass();
    $pm->payment_method = filter_var($paymentmethod['payment_method'], FILTER_SANITIZE_STRING);
    $this->logger->addInfo($pm->payment_method);
    try{
        $mapper = new Paymentmethod($this->db, $this->logger);
        $paymentmethod = $mapper->savePaymentmethod($pm);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $paymentmethod
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

$app->put('/admin/paymentmethod', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $paymentmethod = $data['paymentmethod'];
    $pm = new \stdClass();
    $pm->id = filter_var($paymentmethod['id'], FILTER_SANITIZE_NUMBER_INT);
    $pm->payment_method = filter_var($paymentmethod['payment_method'], FILTER_SANITIZE_STRING);

    try{
        $mapper = new Paymentmethod($this->db, $this->logger);
        $no_of_updated_record = $mapper->updatePaymentmethod($pm);
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

$app->delete('/admin/paymentmethod/{id}', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    try{
        $mapper = new Paymentmethod($this->db, $this->logger);
        $no_of_deleted_record = $mapper->deletePaymentmethod($id);
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
