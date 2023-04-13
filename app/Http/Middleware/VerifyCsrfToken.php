<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */

    //exceções de rotas onde o csrf não será usado.
    protected $except = [
        //desativando a rota do webhook..
        '/stripe/webhook'
    ];
}
