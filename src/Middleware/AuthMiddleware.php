<?php 

// src/Middleware/AuthMiddleware.php
namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {
    // Implementação do middleware de autenticação
    protected $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, $next){
        $secretKey = $this->container->get('settings')['secretKey'];

        $authHeader = $request->getHeader('Authorization');
        if(!$authHeader){
            return $response->withJson(['error'=>'Authorization header not found'],401);
        }
        $token = $authHeader[0];

        try {
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            $request = $request->withAttribute('user', $decoded);
        } catch (\Exception $e) {
            return $response->withJson(['error' => 'Invalid Token'], 401);
        }

        $response = $next($request,$response);
        return $response;
    }
}
