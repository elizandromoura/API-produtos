<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;



$app->group('/api/v1', function(){
    $this->get('/produtos/lista', function($request, $response){


        $produtos = Produto::get();
        return $response->withJson($produtos);
    });

    $this->post('/produtos/add', function($request, $response){
        $token = $request->getParsedBody();
        $secretkey = "c9b1fd873201074268c68a35b94ba54fbb8f76ed";
        
        


        if($token['chave'] === $secretkey){
            $dados = $request->getParsedBody();
            $produto = Produto::create($dados);
            return $response->withJson("Produto adicionado com sucesso.");
        }else{
            return $response->withJson('Erro de autenticação');
        };



        
    });
    $this->put('/produtos/update/{id}', function($request, $response, $args){
        $token = $request->getParsedBody();
        $secretkey = "c9b1fd873201074268c68a35b94ba54fbb8f76ed";


        if($token['chave'] === $secretkey){

            $dados = $request->getParsedBody();
            $produto = Produto::findOrFail($args['id']);
            $produto->update($dados);
            return $response->withJson("Foi alterado com sucesso");
        }else{
            return $response->withJson('Erro de autenticação');
        };



        
    });
    $this->get('/produtos/delete/{id}', function($request, $response, $args){

        $token = $request->getParsedBody();
        $secretkey = "c9b1fd873201074268c68a35b94ba54fbb8f76ed";


        if($token['chave'] === $secretkey){

            $produto = Produto::findOrFail($args['id']);
            $produto->delete();
            return $response->withJson("Foi Deletado com sucesso");
        }else{
            return $response->withJson('Erro de autenticação');
        };


    });
});
