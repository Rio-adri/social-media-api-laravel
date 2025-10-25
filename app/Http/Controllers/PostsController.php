<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index() {
        $sample = Post::all();

        return response()->json([
            'status' => 'success',
            'data' => $sample 
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'content' => 'required|string|max:255',
            'image_url' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $post = Post::create([
            'user_id' => $request->user_id,
            'content' => $request->content,
            'image_url' => $request->image_url
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat post baru.',
            'data' => $post
        ], 201);
    }

    public function show($id) {
        $post = Post::find($id);

        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
            'image_url' => 'nullable'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $post = Post::find($id);

        $post->content = $request->content;
        $post->image_url = $request->image_url;

        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil du update',
            'data' => $post
        ]);
    }

    public function destroy($id) {
        Post::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Post berhasil dihapus'
        ]);
    }
 }
