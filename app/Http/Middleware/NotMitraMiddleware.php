<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotMitraMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->id == 2) {
            return response()->json([
                'errors' => [
                    'name' => 'forbidden access',
                    'message' => 'hanya boleh diakses selain mitra'
                ]
            ], 403);
        }
        return $next($request);
    }
}
