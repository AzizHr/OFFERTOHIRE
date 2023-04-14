<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'required',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $path = 'C:/xampp/htdocs/OTH/OTH-UI/src/assets/users';
            $filename = $image->getClientOriginalName();
            $image->move($path, $filename);
            $data['avatar'] = $filename;
        }

        User::create($data);

        return response()->json([
            'message' => 'User registered successfully'
        ]);
    }
}
