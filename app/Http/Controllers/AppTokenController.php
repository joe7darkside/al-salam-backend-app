<?php

namespace App\Http\Controllers;

use App\Models\AppToken;
use Illuminate\Http\Request;

class AppTokenController extends Controller
{

    /**
     * Store the AppToken in the DB on start.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $token = AppToken::where('token', 'LIKE', $request->token)->first();

        if (!$request->token == $token) {
            $token = AppToken::create(['token' => $request->token]);
            return response()->json('Saved', 200);
        }

        return response()->json('Already exist', 200);
    }


    /**
     * Add user id to AppToken DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
