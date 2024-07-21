<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthRememberToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if($request->session()->has('remember_token') && $request->user()){
            $request->session()->forget('remember_token');
            $request->merge(['remember_token' => true]);
        }
        return $next($request);
    }
}
