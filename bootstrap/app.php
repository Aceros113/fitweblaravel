<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;

/*
|--------------------------------------------------------------------------
| Configuración de la aplicación
|--------------------------------------------------------------------------
|
| Este archivo configura la aplicación Laravel, incluyendo:
| - Rutas web y de consola
| - Middleware globales y aliases
| - Configuración de manejo de excepciones
|
*/

return Application::configure(basePath: dirname(__DIR__))
    // Configuración de rutas
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    // Configuración de middleware
    ->withMiddleware(function (Middleware $middleware) {
        // Alias de middleware personalizado
        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureUserHasRole::class,
        ]);

        // Puedes agregar otros alias o middleware globales aquí
    })
    // Configuración de manejo de excepciones
    ->withExceptions(function (Exceptions $exceptions) {
        // Personaliza el manejo de excepciones si es necesario
        // Ejemplo: reportar excepciones específicas, o registrar logs
    })
    ->create();
