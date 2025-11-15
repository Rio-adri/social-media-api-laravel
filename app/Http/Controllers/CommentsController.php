<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentsController extends Controller
{
    //
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'comment_text' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'comment_text' => $request->comment_text,
        ]);

        return response()->json([
            'succes' => true,
            'message' => 'Comment berhasil dibuat',
            'data' => $comment,
        ], 201);
    }

    public function destroy($id) {
        Comment::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Comment berhasil dihapus',
        ]);
    }
}
