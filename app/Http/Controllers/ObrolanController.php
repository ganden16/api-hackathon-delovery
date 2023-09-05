<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Obrolan;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObrolanController extends Controller
{
    public function getAllChat(Request $request)
    {
        $chat = ChatRoom::where('user_id1', $request->user()->id)->orWhere('user_id2', $request->user()->id)->get();
        if ($chat->count() < 1) {
            return response()->json([
                'message' => 'tidak ada obrolan, kirim pesan untuk membuat obrolan baru'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $chat
        ], 200);
    }
    public function chatRoom($idChatRoom)
    {
        $obrolan = ChatRoom::with('obrolan')->where('id', $idChatRoom)->get();
        return response()->json([
            'data' => $obrolan
        ], 200);
    }
    public function send(Request $request, $idReceiverUser)
    {
        $chatRoom = ChatRoom::where([
            ['user_id1', '=', $request->user()->id],
            ['user_id2', '=', $idReceiverUser]
        ])->orWhere([
            ['user_id2', '=', $request->user()->id],
            ['user_id1', '=', $idReceiverUser]
        ])->first();
        if ($chatRoom->count() < 1) {
            try {
                DB::beginTransaction();
                $newChatRoom = ChatRoom::create([
                    'user_id1' => $request->user()->id,
                    'user_id2' => $idReceiverUser
                ]);
                $request->user()->id;
                Obrolan::create([
                    'chat_room_id' => $newChatRoom->id,
                    'pengirim_id' => $request->user()->id,
                    'penerima_id' => $idReceiverUser,
                    'pesan' => $request['pesan'],
                    'waktu_kirim' => now()
                ]);
                DB::commit();
            } catch (Error $e) {
                DB::rollBack();
            }
        } else {
            Obrolan::create([
                'chat_room_id' => $chatRoom->id,
                'pengirim_id' => $request->user()->id,
                'penerima_id' => $idReceiverUser,
                'pesan' => $request['pesan'],
                'waktu_kirim' => now()
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'pesan berhasil dikirim'
        ]);
    }
    public function deleteMessage($idObrolan)
    {
        $isMessage = Obrolan::find($idObrolan);
        if (!$isMessage) {
            return response()->json([
                'status' => false,
                'message' => 'pesan obrolan tidak ada'
            ], 400);
        }
        Obrolan::destroy($idObrolan);
        return response()->json([
            'status' => true,
            'message' => 'hapus pesan obrolan berhasil, id pesan obrolan = ' . $idObrolan
        ]);
    }
    public function deleteChat($idChat)
    {
        $isChat = ChatRoom::find($idChat);
        if (!$isChat) {
            return response()->json([
                'status' => false,
                'message' => 'room chat tidak ada'
            ], 400);
        }
        ChatRoom::destroy($idChat);
        return response()->json([
            'status' => true,
            'message' => 'hapus room chat berhasil, id room chat = ' . $idChat
        ]);
    }
}
