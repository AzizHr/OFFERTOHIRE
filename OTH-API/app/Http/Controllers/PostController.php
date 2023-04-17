<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::with('user', 'likes', 'likes.user')->get());
    }

    public function show($id)
    {
        if (!Post::where('id', $id)->exists()) {
            return response()->json('No post found');
        }
        return response()->json(Post::with(['user', 'likes', 'likes.user'])->find($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required',
            'content' => 'required',
            'user_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = 'C:/xampp/htdocs/OFFERTOHIRE/OTH-UI/src/assets/posts';
            $filename = $image->getClientOriginalName();
            $image->move($path, $filename);
            $data['image'] = $filename;
        }

        Post::create($data);
        return response()->json('Post created successfully');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where('content', 'like', '%' . $search . '%')->get();
        return response()->json($posts);
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
            return response()->json('Disliked!');
        } else {
            PostLike::create($data);
            return response()->json('Liked!');
        }
    }

    public function destroy($id)
    {
        $post = Post::where('id' , $id);
        $post->delete();
        return response()->json('Post deleted successfully');
    }
}
