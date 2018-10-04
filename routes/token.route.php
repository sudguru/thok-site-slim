<?php

use Ramsey\Uuid\Uuid;
use Firebase\JWT\JWT;
use Tuupola\Base62;

$app->post("/token", function ($request, $response, $arguments) {
    $requested_scopes = $request->getParsedBody() ?: [];
    $valid_scopes = [
        "todo.create",
        "todo.read",
        "todo.update",
        "todo.delete",
        "todo.list",
        "todo.all"
    ];
    $scopes = array_filter($requested_scopes, function ($needle) use ($valid_scopes) {
        return in_array($needle, $valid_scopes);
    });
    $now = new DateTime();
    $future = new DateTime("now +2 hours");
    $server = $request->getServerParams();
    $jti = (new Base62)->encode(random_bytes(16));
    $payload = [
        "iat" => $now->getTimeStamp(),
        "exp" => $future->getTimeStamp(),
        "jti" => $jti,
        "sub" => $server["PHP_AUTH_USER"],
        "scope" => $scopes
    ];
    $secret = "supersecretkeyyoushouldnotcommittogithub";
    $token = JWT::encode($payload, $secret, "HS256");
    $data["token"] = $token;
    $data["expires"] = $future->getTimeStamp();
    return $response->withStatus(201)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->post("/users/authenticate", function ($request, $response, $arguments) {
    $data = $request->getParsedBody();
    
    $login->username = filter_var($data['username'], FILTER_SANITIZE_STRING);
    $login->password = filter_var($data['password'], FILTER_SANITIZE_STRING);
    
    

    try{
        $mapper = new User($this->db);
        $user = $mapper->validateUser($login);
        if($user) {
            $token = generateToken($user, $request);
            $result = [
                'status' => 200,
                'error' => null,
                'data' => $token
            ];
        } else {
            $result = [
                'status' => 200,
                'error' => "Invalid Email/Password.",
                'data' => null
            ];
        }
        
    } catch(PDOException $e) {
        $this->logger->addInfo($e->getMessage());
        $result = [
            'status' => 500,
            'error' => $e->getMessage(),
            'data' => null
        ];
    }

    return $response->withStatus(201)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($result, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

function generateToken ($user, $request) {
    $scopes = [];
    $now = new DateTime();
    $future = new DateTime("now +2 hours");
    $server = $request->getServerParams();
    $jti = (new Base62)->encode(random_bytes(16));
    $payload = [
        "iat" => $now->getTimeStamp(),
        "exp" => $future->getTimeStamp(),
        "jti" => $jti,
        "sub" => $server["PHP_AUTH_USER"],
        "scope" => $scopes,
        "email" => $user->email,
        "firstName" => $user->first_name,
        'lastName' => $user->last_name
    ];
    $secret = "supersecretkeyyoushouldnotcommittogithub";
    $token = JWT::encode($payload, $secret, "HS256");
    return $token;
}
