<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Offer;
use App\Models\OfferApplication;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        return response()->json(User::all());
    }

    public function messages(Request $request, $user_id)
    {
        $sender_id = $request->sender_id;
        $receiver_id = $user_id;

        $messages = UserMessage::where(function ($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $sender_id)
                ->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($sender_id, $receiver_id) {
            $query->where('sender_id', $receiver_id)
                ->where('receiver_id', $sender_id);
        })->with('sender', 'receiver')->get();

        return response()->json($messages);
    }

    public function show($user_id)
    {
        return response()->json(User::with('skills', 'followers', 'followers.follower', 'following', 'following.following')->find($user_id));
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'sender_id' => 'required',
            'receiver_id' => 'required'
        ]);

        UserMessage::create($data);

        return response()->json('Sent!');
    }

    public function newSkill(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'user_id' => 'required'
        ]);

        Skill::create($data);

        return response()->json('New skill created successfully!');
    }

    public function follow(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'follower_id' => $request->follower_id
        ];

        $follower = Follower::where($data);

        if ($follower->exists()) {
            $follower->delete();
            return response()->json('Unfollowed!');
        } else {
            Follower::create($data);
            return response()->json('Followed!');
        }
    }

    public function apply(Request $request)
    {
        $data = [
            'letter' => $request->letter,
            'offer_id' => $request->offer_id,
            'user_id' => $request->user_id
        ];

        $application = OfferApplication::where($data);

        if ($application->exists()) {
            return response()->json('Already applied!');
        } else {
            OfferApplication::create($data);
            return response()->json('Applied successfully!');
        }
    }

    public function companyApplications($company_id)
    {
        return response()->json(Offer::with('applications')->where('company_id', $company_id)->get());
    }

    public function userApplications($user_id)
    {
        return response()->json(OfferApplication::with('offer' , 'offer.company')->where('user_id', $user_id)->get());
    }

    public function destroy($id)
    {
        $user = User::all()->find($id);
        $user->delete();
        return response()->json('User deleted successfully');
    }
}
