<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected function getUsuarioID(Request $request):int {
        $dados = JWT::decode($request->header('Authorization'), config('jwt.senha'), ['HS256']);
        return $dados->id;
    }
}
