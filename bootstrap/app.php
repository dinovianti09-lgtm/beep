<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // Error 401 - Belum login atau token tidak valid
        $exceptions->render(function (
            AuthenticationException $exception,
            Request $request
        ) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated. Silakan login terlebih dahulu.',
                    'data' => null,
                ], 401);
            }

            return null;
        });

        // Error 404
        $exceptions->render(function (
            NotFoundHttpException $exception,
            Request $request
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data atau halaman yang diminta tidak ditemukan.',
                ], 404);
            }

            return response()->view('errors.404', [], 404);
        });

        // Error 403
        $exceptions->render(function (
            AccessDeniedHttpException $exception,
            Request $request
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kamu tidak memiliki izin untuk mengakses data ini.',
                ], 403);
            }

            return response()->view('errors.403', [], 403);
        });

        // Biarkan Laravel menangani validasi
        $exceptions->render(function (
            ValidationException $exception,
            Request $request
        ) {
            return null;
        });

        // Error server 500
        $exceptions->render(function (
            \Throwable $exception,
            Request $request
        ) {
            // Jangan sampai error validasi dianggap sebagai error 500
            if ($exception instanceof ValidationException) {
                return null;
            }

            // Jangan sampai error autentikasi dianggap sebagai error 500
            if ($exception instanceof AuthenticationException) {
                return null;
            }

            $status = $exception instanceof HttpExceptionInterface
                ? $exception->getStatusCode()
                : 500;

            if ($status < 500) {
                return null;
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kendala pada server. Silakan hubungi admin.',
                ], 500);
            }

            return response()->view('errors.500', [], 500);
        });

    })
    ->create();
