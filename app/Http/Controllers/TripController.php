<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function getUserTrip(Request $request)
    {
        $user_id = $request->user()->id;

        $user_trips = User::find($user_id)->trip;

        return response()->json(['User Trips' => $user_trips], 200);
    }

    public function addTrip(Request $request)
    {
        $user_id = $request->user()->id;

        $user_trip = Trip::create([
            'user_id' => $user_id,
            'captain_id' => $request->captain_id,
            'pick_up' => $request->pick_up,
            'drop_of' => $request->drop_of,
            'price' => $request->price,
            'payed' => $request->payed,

        ]);


        return response()->json(['New Trip' => $user_trip], 200);
    }
}
