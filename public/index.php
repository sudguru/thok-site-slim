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
    "path" => "/api",
    "secret" => "supersecretkeyyoushouldnotcommittogithub"
]));

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

$app->run();