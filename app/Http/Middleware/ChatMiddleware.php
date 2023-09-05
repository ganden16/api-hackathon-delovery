<?php

namespace App\Http\Middleware;

use App\Models\ChatRoom;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->idChatRoom) {
            $isMyChat = ChatRoom::where([
                ['id', '=', $request->idChatRoom],
                ['user_id1', '=', $request->user()->id]
            ])->orWhere([
                ['id', '=', $request->idChatRoom],
                ['user_id2', '=', $request->user()->id]
            ])->first();
            if ($isMyChat) {
                return $next($request);
            } else {
                return response()->json([
                    'errors' => [
                        'message' => 'ini bukan chat anda :)'
                    ]
                ]);
            }
        }
        return $next($request);
    }
}
