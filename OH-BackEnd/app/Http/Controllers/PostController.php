<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::with(['user', 'likes', 'likes.user'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required'
        ]);
        // $data['image'] = $request->file('image')->store('images' , 'public');

        Post::create($data);
        return response()->json('Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!Post::where('id', $id)->exists()) {
            return response()->json('No post found');
        }
        return response()->json(Post::with(['user', 'likes'])->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::all()->find($id);
        $post->update($request->all());
        return response()->json('Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Post::where('id', $id)->exists()) {
            return response()->json('No post found');
        }
        return Post::destroy($id);
    }

    /**
     * Search for a post by body.
     */
    public function search($description)
    {
        return response()->json(Post::where('description', 'like', '%' . $description . '%')->get());
    }

    public function like(Request $request)
    {
        $data = [
            'post_id' => $request->post_id,
            'user_id' => $request->user_id
        ];

        $like = PostLike::where($data);

        if ($like->exists()) {
            $like->delete();
            return response()->json(0);
        } else {
            PostLike::create($data);
            return response()->json(1);
        }
    }
}
