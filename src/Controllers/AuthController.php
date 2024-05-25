<?php

//src/Controllers/AuthController.php
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\User;
use Firebase\JWT\JWT;

class AuthController {
    protected $container;

    public function __construct($container){
        $this->container = $container;
    }
    

    public function login(Request $request, Response $response){
        $data = $request->getParsedBody();
        // Verifica se $data existe e se 'username' e 'password' estão definidos
        if (isset($data['username']) && isset($data['password'])) {
            $username = $data['username'];
            $password = $data['password'];

            // Definir o fuso horário (substitua 'America/Sao_Paulo' pelo seu fuso horário)
            date_default_timezone_set('America/Sao_Paulo');

            // Define o tempo atual baseado no fuso horário configurado
            $currentTime = time();
            $user = User::where('username', $username)->first();
            if($user && password_verify($password, $user->password)){
                $token = [
                    'iss' => $user->username,
                    'iat' => $currentTime, // Tempo atual
                    'nbf' => $currentTime + 60 // 1 minuto após o tempo atual
                ];
                $secretKey = $this->container->get('settings')['secretKey'];            

                try {
                    $jwt = JWT::encode($token, $secretKey, 'HS256');
                    return $response->withJson(['token' => $jwt]);
                } catch (\Exception $e) {
                    return $response->withJson(['status' => 'error', 'message' => 'Failed to generate token'], 500);
                }
            } else {
                return $response->withJson(['status' => 'error', 'message' => 'Invalid username or password'], 401);
            }
        } else {
            return $response->withJson(['status' => 'error', 'message' => 'Invalid data format'], 400);
        }
    }

    public function logout(Request $request, Response $response){
        // Como estamos utilizando JWT, não há necessidade de logout no servidor
        return $response->withJson(['status' => 'success','message' => 'Logged out successfully']);
    }
}
