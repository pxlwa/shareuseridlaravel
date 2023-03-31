<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        return response()->json(['id' => $user->id]);
    }

    return response()->json(['errors' => ['email' => ['These credentials do not match our records.']]], 422);
}

}
