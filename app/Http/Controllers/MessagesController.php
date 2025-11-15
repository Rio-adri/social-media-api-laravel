<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessagesController extends Controller
{
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();

        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|integer',
            'message_content' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message_content' => $request->message_content

        ]);

        return response()->json([
            'success' => true,
            'id' => $message->id
        ], 201);
    }

    public function show($id) {
        $message = Message::find($id);

        if(!$message) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $message
        ]);
    }

    public function getMessages($receiver_id) {
        $messages = Message::where('receiver_id',$receiver_id)->get();

        if(!$messages) {
            return response()->json([
                'success' => false,
                'messages' => 'Tidak ada pesan untuk pengguna ini'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $messages
        ], 200);
    }

    public function destroy($id) {
        Message::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus'
        ]);
    }
}
