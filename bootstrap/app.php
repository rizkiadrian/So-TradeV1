<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;


use App\Exceptions\CustomValidationException;
use App\Exceptions\GlobalException;
use App\Exceptions\AuthenticationException as InternalAuthException;
use App\Exceptions\NotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        // $middleware->append(CheckFinancialUser::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return (new NotFoundException())->render($request, $e);
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return (new InternalAuthException())->render($request, $e);
        });

        $exceptions->render(function (ValidationException $e, Request $request) {
            return (new CustomValidationException)->render($request, $e);
        });

        $exceptions->render(function (Exception $e, Request $request) {
            return (new GlobalException())->render($request, $e);
        });

        
    })->create();
