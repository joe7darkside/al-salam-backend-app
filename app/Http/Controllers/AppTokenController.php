<?php

namespace App\Http\Controllers;

use App\Models\AppToken;
use Illuminate\Http\Request;

class AppTokenController extends Controller
{
    public function store(Request $request)
    {
        $token = AppToken::where('token', 'LIKE', $request->token)->first();

        if (!$request->token == $token) {
            $token = AppToken::create(['token' => $request->token]);
            return response()->json('Saved', 200);
        }

        return response()->json('Already exist', 200);
    }



    public function update(Request $request)
    {
        $user = $request->user()->id;
        $token = AppToken::where('token', 'LIKE', $request->token)->first();

        if (!$token) {
            $token = AppToken::create([
                'token' => $request->token,
                'user_id' => $user
            ]);
            return response()->json('Saved', 200);
        }

        $token->update([
            'token' => $request->token,
            'user_id' => $user
        ]);
        return response()->json('Updated', 200);
    }
}
