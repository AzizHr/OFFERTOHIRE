<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferLike;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        return response()->json(Offer::with('company', 'likes', 'likes.user')->get());
    }

    public function show($id)
    {
        if (!Offer::where('id', $id)->exists()) {
            return response()->json('No offer found');
        }
        return response()->json(Offer::with(['company', 'likes', 'likes.user'])->find($id));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required',
            'content' => 'required',
            'company_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = 'C:/xampp/htdocs/OTH/OTH-UI/src/assets/offers';
            $filename = $image->getClientOriginalName();
            $image->move($path, $filename);
            $data['image'] = $filename;
        }

        Offer::create($data);
        return response()->json('Offer created successfully');
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
            return response()->json('Disliked!');
        } else {
            OfferLike::create($data);
            return response()->json('Liked!');
        }
    }
}
