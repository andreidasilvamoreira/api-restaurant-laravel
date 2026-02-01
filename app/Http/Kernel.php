<?php

namespace App\Http;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [

    ];

    protected $middlewareGroups = [
        'web' => [
            // middlewares do grupo web
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'ativo' => \App\Http\Middleware\EnsureUserIsActive::class,
        'role' => \App\Http\Middleware\CheckRole::class,
    ];

}
