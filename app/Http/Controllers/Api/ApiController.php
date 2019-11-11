<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class ApiController extends Controller
{
    protected function getUsuarioID(Request $request):int {
        $dados = JWT::decode($request->header('Authorization'), ENV('jwt.senha'), ['HS256']);
        return $dados->id;
    }
}
