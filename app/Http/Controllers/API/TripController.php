<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DropOf;
use Illuminate\Http\Request;
use App\Models\PickUp;
use App\Models\PreTrip;
use App\Models\Trip;

class TripController extends Controller
{
    public function userTripsHistory(Request $request)
    {
        $trips = $request->user()->trip;

        foreach ($trips as  $trip) {

            $trip->pickUp;
            $trip->dropOf;
        }

        return response()->json($trip, 200);
    }


    public function addTrip(Request $request)
    {
        $user_id = $request->user()->id;

        PreTrip::create([
            'user_id' => $user_id,

        ]);

        return response()->json(200, 200);
    }


    public function addPickUp(Request $request)
    {
        $user_pre_trip_id = $request->user()->preTrip->id;

        PickUp::create([
            'trip_id' => $user_pre_trip_id,
            'block' => $request->block,
            'unit' => $request->unit
        ]);

        return response()->json(200, 200);
    }


    public function addDropOf(Request $request)
    {
        $user_pre_trip_id = $request->user()->preTrip->id;

        $trip_pick_up = DropOf::create([
            'trip_id' => $user_pre_trip_id,
            'block' => $request->block,
            'unit' => $request->unit
        ]);

        return response()->json(['Pickup' => $trip_pick_up], 200);
    }

    public function addCost(Request $request)
    {
        $user_pre_trip_id = $request->user()->preTrip;

        $add_cost = $user_pre_trip_id->update([
            'cost' => $request->cost,
            'payment_method' => $request->payment_method,

        ]);

        return response()->json(['Cost' => $add_cost], 200);
    }


    public function orderTrip(Request $request)
    {
        $user_id = $request->user()->id;
        $user_preTrip_id = $request->user()->preTrip;

        $new_trip = Trip::create([
            'id' => $user_preTrip_id->id,
            'user_id' => $user_id,
            'captain_id' => $request->captain_id,
            'cost' => $user_preTrip_id->cost,
            'payment_method' => $user_preTrip_id->payment_method,
        ]);
        return response()->json(['user' => $new_trip]);
    }


    public function getCaptainDetails($id)
    {

        $captain_details = Trip::find($id)->captain;



        return response()->json($captain_details);
    }
}
