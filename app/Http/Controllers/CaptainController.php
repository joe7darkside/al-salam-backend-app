<?php

namespace App\Http\Controllers;

use App\Models\Captain;
use Illuminate\Http\Request;

class CaptainController extends Controller
{

    // Fetch all captains in DB.

    public function captains()
    {
        $captain_trips = Captain::all();

        return response()->json(['captains' => $captain_trips]);
    }





    public function getCaptainTrips($id)
    {
        $captain_trips = Captain::find($id)->trip;

        return response()->json(['Captain Trips' => $captain_trips]);
    }





    public function captainTrips(Request $request)
    {

        $captain_id = $request->user()->id;
        $captain_trips = Captain::find($captain_id)->trip;

        return response()->json(['Captain trips' => $captain_trips]);
    }
}
