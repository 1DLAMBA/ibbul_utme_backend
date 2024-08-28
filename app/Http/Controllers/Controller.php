<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function login(Request $request)
    {

        $request->validate([
            // in this case the username from the frontend
            // comes as "email"
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if ($user) {
            if ($user->password == $password) {
                return response()->json(['message' => 'Login successful'], 200);
            } else {
                return response()->json(['message' => 'Invalid password'], 401);
            }
            // return;
        } else {
            return response()->json(['message' => 'Invalid Credentials'], 401);

        };
    }
}
