<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    /**
     * Return a json response of the user information
     *
     * @return array
     */

    public function getUserInfo(Request $request)
    {
        $user = $request->user();


        return response()->json(['User' => $user]);
    }

    /**
     * Return a json response of the user visa cards
     *
     * @return array
     */
    public function getVisaCard(Request $request)
    {
        $user_id = $request->user()->id;
        $user_cards = User::find($user_id)->VisaCard;

        return response()->json(['User Cards' => $user_cards]);
    }
}
