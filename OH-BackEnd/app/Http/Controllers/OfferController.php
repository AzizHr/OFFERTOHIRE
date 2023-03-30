<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferLike;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Offer::with(['user', 'likes', 'likes.user'])->get());
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

        Offer::create($data);
        return response()->json('Offer created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!Offer::where('id', $id)->exists()) {
            return response()->json('No offer found');
        }
        return response()->json(Offer::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Offer::find($id);
        $post->update($request->all());
        return response()->json('Offer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Offer::where('id', $id)->exists()) {
            return response()->json('No offer found');
        }
        return Offer::destroy($id);
    }

    /**
     * Search for a post by description.
     */
    public function search($description)
    {
        return response()->json(Offer::where('description', 'like', '%' . $description . '%')->get());
    }

    public function like(Request $request)
    {
        $data = [
            'offer_id' => $request->offer_id,
            'user_id' => $request->user_id
        ];

        $like = OfferLike::where($data);

        if ($like->exists()) {
            $like->delete();
            return response()->json(0);
        } else {
            OfferLike::create($data);
            return response()->json(1);
        }
    }
}
