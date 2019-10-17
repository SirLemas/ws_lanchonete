<?php

namespace App\Http\Middleware;

use Closure;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $jwt = $request->header('Authorization');
            $dados = JWT::decode($jwt, ENV('jwt.senha'), ['HS256']);
            return $next($request);
        } catch (\Exception $e) { 
            return response()->json(['erro' => 'Token inválido'], 403);
        }
    }
}
