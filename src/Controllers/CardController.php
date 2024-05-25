<?php

//src/Controllers/CardController.php
namespace App\Controllers;

use App\Models\Card;
use App\Models\Edition;
use Psr\Cache\CacheItemPoolInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class CardController {
    protected $cache;

    public function __construct(CacheItemPoolInterface $cache){
        $this->cache = $cache;
    }

    //Listar todas as cartas com caching
    public function getAll(Request $request, Response $response){
        $cacheKey = 'all_cards';

        //Verifica se todos os dados estão em cache
        $cacheItem = $this->cache->getItem($cacheKey);
        if(!$cacheItem->isHit()){
            // Dados não estão em cache, buscar do banco de dados
            $cards = Card::all();

            //Armazena os dados em cache por 1h
            $cacheItem->set($cards)->expiresAfter(3600);
            $this->cache->save($cacheItem);
        }else{
            //Dados estão em cache, recuperar do cache
            $cards = $cacheItem->get();
        }
        return $response->withJson(($cards));
    }

    //Carta por ID
    public function getById(Request $request, Response $response, $args){
        $card = Card::find($args['id']);
        if($card){
            return $response->withJson($card);
        }else{
            return $response->withJson(['error'=>'Card not found'],404);
        }
    }

    //Criar Carta
    public function create(Request $request, Response $response){
        $cacheKey = 'all_cards';
        $this->cache->deleteItem($cacheKey);

        $data = $request->getParsedBody();

        //Verifica se edição existe
        if(!Edition::find($data['edition_id'])){
            return $response->withJson(['error'=>'Invalid edition ID'],400);
        }

        $card = Card::create($data);
        return $response->withJson($card, 201);
    }

    //Atualiza carta por ID
    public function update(Request $request, Response $response, $args){
        $cacheKey = 'all_cards';
        $this->cache->deleteItem($cacheKey);
        
        $data = $request->getParsedBody();
        $card = Card::find($args['id']);

        if($card){
            //Verifica se a edição existe
            if(isset($data['edition_id']) && !Edition::find($data['edition_id'])){
                return $response->withJson(['error'=>'Invalid Edition ID',400]);
            }

            $card->update($data);
            return $response->withJson($card);
        }else{
            return $response->withJson(['error'=>'Card not found'], 404);
        }
    }

    //Deleta carta por ID
    public function delete(Request $request, Response $response, $args){
        $card = Card::find($args['id']);

        if($card){
            $card->delete();
            return $response->withJson(['message'=>'Card Deleted']);
        }else{
            return $response->withJson(['error'=>'Card not found',404]);
        }
    }

}