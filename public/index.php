<?php

require '../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = '127.0.0.1';
$config['db']['user']   = 'root';
$config['db']['pass']   = '';
$config['db']['dbname'] = 'thoksaman';

$app = new \Slim\App(['settings' => $config]);

$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path" => ["/admin", "/user"],
    "secret" => "supersecretkeyyoushouldnotcommittogithub"
]));

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});



$container = $app->getContainer();


//Logger
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../monologs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

//Database
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['view'] = new \Slim\Views\PhpRenderer('../views/');

require '../routes/home.route.php';

require '../routes/token.route.php';
require '../routes/admin.category.route.php';
require '../routes/admin.paymentmethod.route.php';
require '../routes/admin.setting.route.php';
require '../routes/admin.content.route.php';

$app->run();
