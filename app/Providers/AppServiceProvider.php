<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        RateLimiter::for('api-login', function (Request $request) {
            $identity = strtolower(trim((string) $request->input('identity')));
            $ip = $request->ip();

            return Limit::perMinute(5)
                ->by($identity . '|' . $ip)
                ->response(function (Request $request, array $headers) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Terlalu banyak percobaan login. Silakan coba lagi setelah satu menit.',
                    ], 429, $headers);
                });
        });
    }
}