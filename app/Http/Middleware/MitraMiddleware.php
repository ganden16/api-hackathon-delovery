<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MitraMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role_id != 2) {
            return response()->json([
                'errors' => [
                    'name' => 'forbidden access',
                    'message' => 'hanya boleh diakses mitra'
                ]
            ], 403);
        }
        return $next($request);
    }
}