<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;

class MessagesController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'sender_id' => 'required|integer',
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
            'sender_id' => $request->sender_id,
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

    public function destroy($id) {
        Message::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus'
        ]);
    }
}
