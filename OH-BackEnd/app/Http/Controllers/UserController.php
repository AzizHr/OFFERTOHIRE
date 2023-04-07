<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use App\Models\Follow;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json('Registration Success');
    }

    public function show($user_id)
    {
        return response()->json(User::with('skills')->find($user_id));
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validatedData)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = User::where('email', $validatedData['email'])->firstOrFail();

        return response()->json($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function userInfo($user_id)
    {
        return response()->json(User::with('sent', 'received.sender')->where('id', $user_id)->get());
    }

    public function messages(Request $request, $message_from)
    {
        $user1 = User::find($message_from);
        $user2 = User::find($request->message_to);

        $messages = Message::where(function ($query) use ($user1, $user2) {
            $query->where('message_from', $user1->id)->where('message_to', $user2->id);
        })
            ->orWhere(function ($query) use ($user1, $user2) {
                $query->where('message_from', $user2->id)->where('message_to', $user1->id);
            })
            ->with('sender')
            ->get();

        return response()->json($messages);
    }


    public function follows($user_id)
    {
        return response()->json(User::with('followers', 'followers.follower', 'following', 'following.follow')->where('id', $user_id)->get());
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'message_from' => 'required',
            'message_to' => 'required'
        ]);

        Message::create($data);

        return response()->json('Sent!');
    }

    public function follow(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'followed_by' => $request->followed_by
        ];

        $follow = Follow::where($data);

        if ($follow->exists()) {
            $follow->delete();
            return response()->json('Unfollowed!');
        } else {
            Follow::create($data);
            return response()->json('Followed!');
        }
    }

    public function apply(Request $request)
    {
        $data = $request->validate(
            [
                'offer_id' => 'required',
                'from_user' => 'required',
                'to_company' => 'required'
            ]
        );

        if (Apply::where($data)->exists()) {
            return response()->json('Already Applied');
        }

        Apply::create($data);
        return response()->json('Applied!');
    }
}
