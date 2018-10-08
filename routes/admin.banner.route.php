<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$app->get('/admin/banners', function(Request $req, Response $res) {
    try{
        $mapper = new Banner($this->db, $this->logger);
        $banners = $mapper->getBanners();
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $banners
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


$app->get('/admin/banner/:id', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    try{
        $mapper = new Banner($this->db, $this->logger);
        $banner = $mapper->getBanner($id);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $banner
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

$app->put('/admin/banner', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $banner = $data['banner'];
    $b = new \stdClass();
    $b->id = filter_var($banner['id'], FILTER_SANITIZE_NUMBER_INT);
    $b->position = filter_var($banner['position'], FILTER_SANITIZE_STRING);

    try{
        $mapper = new Banner($this->db, $this->logger);
        $no_of_updated_record = $mapper->updateBanner($b);
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

$app->delete('/admin/banner/{id}', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    try{
        $mapper = new Banner($this->db, $this->logger);
        $no_of_deleted_record = $mapper->deleteBanner($id);
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


$app->post('/admin/uploadbanner', function(Request $request, Response $response) {


    $upload_dir = "../public/uploads/banner/";
    $data = $request->getParsedBody();
    $photo = $data['myFile'];
    $filename = $data['filename'];
    $position = $data['position'];

    $secret = $data['secret'];
    if ($secret != 'SudeepsSecret') {
        return $response->withJson('Upload Denied');
    }
    // $this->logger->addInfo(print_r($photo,true));
    
    $img = str_replace('data:image/png;base64,', '', $photo);
    $img = str_replace('data:image/jpeg;base64,', '', $photo);
    $img = str_replace(' ', '+', $img);
    $imagedata = base64_decode($img);
    $file = $upload_dir . $filename;
    try{
        $mapper = new Category($this->db, $this->logger);
        $no_of_updated_record = $mapper->addBanner($filename, $position, $id);
        $this->logger->addInfo('banner updated ' . $no_of_updated_record);

        $success = file_put_contents($file, $imagedata);
        $result = [
            'status' => 200,
            'error' => null,
            'data' => $filename
        ];
    } catch(PDOException $e) {
        $this->logger->addInfo($e->getMessage());
        $result = [
            'status' => 500,
            'error' => 'Upload Permission Denied',
            'data' => null
        ];
    }

    return $response->withJson($result);


});
