<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/admin/rootcategories', function(Request $req, Response $res) {
    try{
        $mapper = new Category($this->db, $this->logger);
        $categories = $mapper->getRootCategories();
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

$app->get('/admin/categories', function(Request $req, Response $res) {
    try{
        $mapper = new Category($this->db, $this->logger);
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
        $mapper = new Category($this->db, $this->logger);
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
        $mapper = new Category($this->db, $this->logger);
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

$app->put('/admin/category', function(Request $req, Response $res) {
    $data = $req->getParsedBody();
    $category = $data['category'];
    $cat = new \stdClass();
    $cat->id = filter_var($category['id'], FILTER_SANITIZE_NUMBER_INT);
    $cat->category = filter_var($category['category'], FILTER_SANITIZE_STRING);
    $cat->description = filter_var($category['description'], FILTER_SANITIZE_STRING);
    $cat->parent_id = filter_var($category['parent_id'], FILTER_SANITIZE_NUMBER_INT);
    $this->logger->addInfo("parent id is $cat->parent_id");
    try{
        $mapper = new Category($this->db, $this->logger);
        $no_of_updated_record = $mapper->updateCategory($cat);
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

$app->delete('/admin/category/{id}', function(Request $req, Response $res, $args) {
    $id = $args['id'];
    try{
        $mapper = new Category($this->db, $this->logger);
        $no_of_deleted_record = $mapper->deleteCategory($id);
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


$app->post('/admin/uploadphoto', function(Request $request, Response $response) {


    $upload_dir = "../public/uploads/";
    $data = $request->getParsedBody();
    $photo = $data['myFile'];
    $filename = $data['filename'];
    $id = $data['id'];
    $this->logger->addInfo('id is ' . $id);

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
        $no_of_updated_record = $mapper->updateBanner($filename, $id);
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
