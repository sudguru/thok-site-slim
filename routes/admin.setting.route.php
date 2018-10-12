<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



$app->get('/admin/setting', function(Request $req, Response $res) {
    $id = 1;
    try{
        $mapper = new Setting($this->db, $this->logger);
        $setting = $mapper->getSetting($id);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $setting
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

  

$app->put('/admin/setting', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $setting = $data['setting'];
    $s = new \stdClass();
    $s->id = filter_var($setting['id'], FILTER_SANITIZE_NUMBER_INT);
    $s->site_name = filter_var($setting['site_name'], FILTER_SANITIZE_STRING);
    $s->phone1 = filter_var($setting['phone1'], FILTER_SANITIZE_STRING);
    $s->phone2 = filter_var($setting['phone2'], FILTER_SANITIZE_STRING);
    $s->address = filter_var($setting['address'], FILTER_SANITIZE_STRING);
    $s->email = filter_var($setting['email'], FILTER_SANITIZE_STRING);
    $s->order_email = filter_var($setting['order_email'], FILTER_SANITIZE_STRING);
    $s->description = filter_var($setting['description'], FILTER_SANITIZE_STRING);
    $s->facebook = filter_var($setting['facebook'], FILTER_SANITIZE_STRING);
    $s->twitter = filter_var($setting['twitter'], FILTER_SANITIZE_STRING);
    $s->googleplus = filter_var($setting['googleplus'], FILTER_SANITIZE_STRING);
    $s->youtube = filter_var($setting['youtube'], FILTER_SANITIZE_STRING);
    $s->viber = filter_var($setting['viber'], FILTER_SANITIZE_STRING);
    $s->whatsapp = filter_var($setting['whatsapp'], FILTER_SANITIZE_STRING);
    $s->skype = filter_var($setting['skype'], FILTER_SANITIZE_STRING);

    try{
        $mapper = new Setting($this->db, $this->logger);
        $no_of_updated_record = $mapper->updateSetting($s);
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
