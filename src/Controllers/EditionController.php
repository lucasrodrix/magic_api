<?php
//src/Controllers/EditionController.php
namespace App\Controllers;

use App\Models\Edition;
use Slim\Http\Request;
use Slim\Http\Response;

class EditionController {
    // Implementação do controlador de edições
    public function getAll(Request $request, Response $response){
        $editions = Edition::all();
        return $response->withJson($editions);
    }

    public function getById(Request $request, Response $response, $args){
        $edition = Edition::find($args['id']);
        if($edition){
            return $response->withJson($edition);
        }
        return $response->withJson(['error'=>'Edition not found'],404);
    }

    public function create(Request $request, Response $response){
        $data = $request->getParsedBody();
        $edition = Edition::create($data);
        return $response->withJson($edition, 201);
    }

    public function update(Request $request, Response $response, $args){
        $data = $request->getParsedBody();
        $edition = Edition::find($args['id']);
        if($edition){
            $edition->update($data);
            return $response->withJson($edition);
        }
        return $response->withJson(['error'=>'Edition not found',404]);
    }

    public function delete(Request $request, Response $response, $args){
        $edition = Edition::find($args['id']);
        if($edition){
            $edition->delete();
            return $response->withJson(['message'=>'Edition Deleted']);
        }
        return $response->withJson(['error'=>'Edition not found',404]);
    }
}
