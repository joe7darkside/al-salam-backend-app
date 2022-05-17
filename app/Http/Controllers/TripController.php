<?php

namespace App\Http\Controllers;

use App\Models\DropOf;
use App\Models\PickUp;
use App\Models\PreTrip;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function getUserTrip(Request $request)
    {
        $user_id = $request->user()->id;

        $user_trips = User::find($user_id)->trip;

        foreach ($user_trips as $key => $trip) {
            $trip_id = $trip;
            $trip_pick_up = $trip_id->pickUp;
            $trip_drop_of = $trip_id->dropOf;
        }


        return response()->json(['User Trips' => $trip_id], 200);
    }

    public function getUserPreTrip(Request $request)
    {
        $user_id = $request->user()->id;

        $user_trips = User::find($user_id)->preTrip;

        return response()->json(['User Trips' => $user_trips], 200);
    }




    public function addTrip(Request $request)
    {
        $user_id = $request->user()->id;

        $new_trip = PreTrip::create([
            'user_id' => $user_id,

        ]);

        return response()->json(['New Trip' => $new_trip], 200);
        // $user_trip = Trip::create([
        //     'user_id' => $user_id,
        //     'captain_id' => $request->captain_id,
        //     'pick_up' => $request->pick_up,
        //     'drop_of' => $request->drop_of,
        //     'price' => $request->price,
        //     'payed' => $request->payed,

        // ]);

    }


    public function addPickUpPoint(Request $request)
    {
        $user_pre_trip_id = $request->user()->preTrip->id;

        // $user_pre_trip_id->pickUp;
        $trip_pick_up = PickUp::create([
            'trip_id' => $user_pre_trip_id,
            'block' => $request->block,
            'unit' => $request->unit
        ]);



        return response()->json(['test' => $trip_pick_up], 200);
    }


    public function addDropOfPoint(Request $request)
    {
        $user_pre_trip_id = $request->user()->preTrip->id;

        // $user_pre_trip_id->pickUp;
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



        return response()->json(['Captain details' => $captain_details]);
    }
}
