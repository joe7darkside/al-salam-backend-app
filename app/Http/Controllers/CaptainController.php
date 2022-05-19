<?php

namespace App\Http\Controllers;

use App\Models\Captain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CaptainController extends Controller
{

    /**
     * Update the specified center in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateCaptain(Request $request, $id)
    {

        $captain = Captain::find($id);

        if ($captain) {
            $captain->update($request->all());
            return View::make('dashboard.captains.overview')
                ->with('Message', 'updated successfully.');
        } else {
            return View::make('dashboard.captains.overview')
                ->with('Message', 'No Data Updated');
        }
    }

    /**
     * Remove the specified center from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $captain = Captain::find($id);

        if ($captain) {
            $captain->delete();
            return View::make('dashboard.captains.overview')
                ->with('Message', 'Deleted Successfully.');
        } else {
            return View::make('dashboard.captains.overview')
                ->with('Message', 'Record Faild to Deleted');
        }
    }


    /**
     * Return overview view with array search results of captains
     * @param Request $request
     * @return View|array
     */

    public function search(Request $request)
    {

        $search_text = $request->input('search');


        if (isset($search_text)) {
            $captains = Captain::where('first_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('phone', 'LIKE', '%' . $search_text . '%')
                ->orWhere('email', 'LIKE', '%' . $search_text . '%')
                ->orWhere('vehicle', 'LIKE', '%' . $search_text . '%')
                ->orWhere('licence_plate', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $captains->appends($request->all());

            // return response()->json(['captains' => $captains]);
            return View::make('dashboard.captains.overview',  ['captains' => $captains]);
        }
        $captains =  Captain::orderBy('created_at', 'desc')->paginate(10);


        // return response()->json(['captains' => $captains]);
        return View::make('dashboard.captains.overview',  ['captains' => $captains]);
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


    /**
     * Return overview view with array of captains
     * @param Request $request
     * @return View|array
     */

    public function getCaptains()
    {
        $captains = Captain::orderBy('created_at', 'desc')->paginate(10);


        return response()->json(['captains' => $captains]);
    }



    /**
     * Return profile view with captain details
     * @param Request $request
     * @return View
     */

    public function getCaptainProfile($id)
    {
        $captain = Captain::find($id);

        $trips = $captain->trip;


        return View::make('dashboard.captains.profile',  ['captain' => $captain]);
        // return response()->json(['captain' => $captain]);
    }
}
