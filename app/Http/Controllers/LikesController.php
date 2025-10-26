<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Like;

class LikesController extends Controller
{
    //
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'post_id' => 'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }

        $like = Like::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan like',
            'data' => $like
        ]);
    }

    public function destroy($id) {
        Like::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus like'
        ]);
    }
}
