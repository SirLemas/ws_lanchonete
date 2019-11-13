<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cardapio;

class CardapiosController extends ApiController
{
    public function listar(Request $req){
        $id_usuario = $this->getUsuarioID($req);
        $cardapio = Cardapio::where('id_usuario', $id_usuario)->get();
        return response()->json($cardapio, 200);
    }
    
    public function buscar(Request $req, int $id){
        $id_usuario = $this->getUsuarioID($req);
        $cardapio = Cardapio::where('id', $id)->where('id_usuario', $id_usuario)->firstOrFail();
        return response()->json($cardapio, 200);
    }

    public function cadastrar(Request $req){
        $validator = Validator::make($req->cardapio, [
            'nome' => 'required',
            'preco' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $cardapio = $req->cardapio;
        $cardapio['id_usuario'] = $this->getUsuarioID($req);
        $cardapio = Cardapio::create($cardapio);

        return response()->json($cardapio, 201);
        
    }

    public function atualizar(Request $req, int $id){
        $id_usuario = $this->getUsuarioID($req);
        $cardapio = Cardapio::where('id', $id)->where('id_usuario', $id_usuario)->firstOrFail();
        $validator = Validator::make($req->cardapio, [
            'nome' => 'required',
            'preco' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $cardapio->nome = $req->cardapio['nome'];
        $cardapio->preco = $req->cardapio['preco'];
        $cardapio->descricao = $req->cardapio['descricao'];
        $cardapio->save();

        return response()->json($cardapio, 201);
    }
    public function deletar(Request $req, int $id){
        $id_usuario = $this->getUsuarioID($req);
        $cardapio = Cardapio::where('id', $id)->where('id_usuario', $id_usuario)->firstOrFail();
        $cardapio->delete();

        return response()->json('Ação realizada com sucesso', 200);
    }
}
