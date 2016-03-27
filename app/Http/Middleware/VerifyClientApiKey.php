<?php

namespace App\Http\Middleware;

use Closure;

class VerifyClientApiKey
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        if (!$apiKey || $apiKey !== config('services.client.api_key')) {
            return response()->json(['error' => 'Unauthorized API request'], 401);
        }
        return $next($request);
    }
}
