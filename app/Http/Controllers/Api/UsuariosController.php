<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class UsuariosController extends ApiController
{
    public function logar(Request $req){
        $usuario = Usuario::where('login', $req->login)
                            ->where('senha', md5($req->login))
                            ->firstOrFails();
        $jwt = JWT::encode(['id' => $usuario->id], ENV('jwt.senha'));
        return response()->json(['jwt' => $jwt], 200);
    }

    public function cadastrar(Request $req){
        $validation = Validator::make([
            'login' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|min:6'
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 400);
        }else{
            $usuario = $req->usuario;
            $usuario['senha'] = md5($usuario['senha']);
            $usuario = Usuario::create($usuario);
            return response()->json($usuario, 201);
        }
    }
}
