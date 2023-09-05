<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PelangganMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role_id != 3) {
            return response()->json([
                'errors' => [
                    'name' => 'forbidden access',
                    'message' => 'hanya boleh diakses pelanggan'
                ]
            ], 403);
        }
        return $next($request);
    }
}
