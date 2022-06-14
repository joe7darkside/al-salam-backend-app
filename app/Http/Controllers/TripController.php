<?php

namespace App\Http\Controllers;

use App\Models\DropOf;
use App\Models\PickUp;
use App\Models\PreTrip;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TripController extends Controller
{
    // public function getUserTrip(Request $request)
    // {
    //     $user_id = $request->user()->id;

    //     $user_trips = User::find($user_id)->trip;

    //     foreach ($user_trips as  $trip) {
    //         $trip_id = $trip;
    //         $trip_id->pickUp;
    //         $trip_id->dropOf;
    //     }


    //     return response()->json(['User Trips' => $trip_id], 200);
    // }

    public function getUserPreTrip(Request $request)
    {
        $user_id = $request->user()->id;

        $user_trips = User::find($user_id)->preTrip;

        return response()->json(['User Trips' => $user_trips], 200);
    }




    // public function addTrip(Request $request)
    // {
    //     $user_id = $request->user()->id;

    //     $new_trip = PreTrip::create([
    //         'user_id' => $user_id,

    //     ]);

    //     return response()->json(['New Trip' => $new_trip], 200);
    //     // $user_trip = Trip::create([
    //     //     'user_id' => $user_id,
    //     //     'captain_id' => $request->captain_id,
    //     //     'pick_up' => $request->pick_up,
    //     //     'drop_of' => $request->drop_of,
    //     //     'price' => $request->price,
    //     //     'payed' => $request->payed,

    //     // ]);

    // }


    // public function addPickUpPoint(Request $request)
    // {
    //     $user_pre_trip_id = $request->user()->preTrip->id;

    //     // $user_pre_trip_id->pickUp;
    //     $trip_pick_up = PickUp::create([
    //         'trip_id' => $user_pre_trip_id,
    //         'block' => $request->block,
    //         'unit' => $request->unit
    //     ]);



    //     return response()->json(['test' => $trip_pick_up], 200);
    // }


    // public function addDropOfPoint(Request $request)
    // {
    //     $user_pre_trip_id = $request->user()->preTrip->id;

    //     // $user_pre_trip_id->pickUp;
    //     $trip_pick_up = DropOf::create([
    //         'trip_id' => $user_pre_trip_id,
    //         'block' => $request->block,
    //         'unit' => $request->unit
    //     ]);

    //     return response()->json(['Pickup' => $trip_pick_up], 200);
    // }

    // public function addCost(Request $request)
    // {
    //     $user_pre_trip_id = $request->user()->preTrip;

    //     $add_cost = $user_pre_trip_id->update([
    //         'cost' => $request->cost,
    //         'payment_method' => $request->payment_method,

    //     ]);

    //     return response()->json(['Cost' => $add_cost], 200);
    // }


    // public function orderTrip(Request $request)
    // {
    //     $user_id = $request->user()->id;
    //     $user_preTrip_id = $request->user()->preTrip;

    //     $new_trip = Trip::create([
    //         'id' => $user_preTrip_id->id,
    //         'user_id' => $user_id,
    //         'captain_id' => $request->captain_id,
    //         'cost' => $user_preTrip_id->cost,
    //         'payment_method' => $user_preTrip_id->payment_method,
    //     ]);
    //     return response()->json(['user' => $new_trip]);
    // }


    // public function getCaptainDetails($id)
    // {

    //     $captain_details = Trip::find($id)->captain;



    //     return response()->json(['Captain details' => $captain_details]);
    // }


    // /**
    //  * Return overview view with array of trips
    
    //  * @return View|array
    //  */

    // public function getTrips(Request $request)
    // {
    //     $admin = $request->user()->first_name;

    //     $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])->orderBy('created_at', 'desc')->paginate(10);

    //     // return response()->json(['trips' => $trips]);
    //     return View::make('dashboard.trips.overview', ['trips' => $trips, 'admin' => $admin]);
    // }

    // /**
    //  * Return overview view with array of search results trips
    
    //  * @return View|array
    //  */

    // public function search(Request $request)
    // {
    //     $admin = $request->user()->first_name;
    //     $search_text = $request->input('search');

    //     // $user = User::with('Profile')->where('status', 1)->whereHas('Profile', function($q){
    //     //     $q->where('gender', 'Male');
    //     // })->get();


    //     if (isset($search_text)) {
    //         $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])
    //             ->where('cost', 'LIKE', '%' . $search_text . '%')
    //             ->orWhere('payment_method', 'LIKE', '%' . $search_text . '%')
    //             ->orWhereHas('user', function ($q) use ($search_text) {
    //                 $q->where('first_name', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
    //             })
    //             ->orWhereHas('captain', function ($q) use ($search_text) {
    //                 $q->where('first_name', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
    //             })
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(10);

    //         $trips->appends($request->all());

    //         return View::make('dashboard.trips.overview',  ['trips' => $trips, 'admin' => $admin]);
    //     }
    //     $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])->orderBy('created_at', 'desc')->paginate(10);

    //     return View::make('dashboard.trips.overview',  ['trips' => $trips, 'admin' => $admin]);
    // }


    // /**
    //  * Return overview view with array of trips
    
    //  * @return View|array
    //  */

    // public function categorizedTrips($category, Request $request)
    // {
    //     $admin = $request->user()->first_name;

    //     $trips = Trip::where('payment_method', 'LIKE', '%' . $category . '%')
    //         ->with(['user', 'captain', 'pickUp', 'dropOf'])
    //         ->orderBy('created_at', 'desc')->paginate(10);

    //     switch ($category) {
    //         case 1:
    //             $category_name = "Complete";
    //             break;
    //         case 0:
    //             $category_name = "Canceled";
    //             break;

    //         default:

    //             break;
    //     }

    //     return View::make('dashboard.trips.categorized', [
    //         'trips' => $trips,
    //         'category_name' => $category_name,
    //         'category' => $category,
    //         'admin' => $admin
    //     ]);
    // }



    // /**
    //  * Return overview view with array of search results trips
    
    //  * @return View|array
    //  */

    // public function categorizedSearch(Request $request, $category)
    // {
    //     $search_text = $request->input('search');
    //     $admin = $request->user()->first_name;

    //     switch ($category) {
    //         case 1:
    //             $category_name = "Complete";
    //             break;
    //         case 0:
    //             $category_name = "Canceled";
    //             break;

    //         default:

    //             break;
    //     }


    //     if (isset($search_text)) {
    //         $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])
    //             ->where('payment_method', 'LIKE', '%' . $category . '%')
    //             ->where('cost', 'LIKE', '%' . $search_text . '%')
    //             ->orWhereHas('user', function ($q) use ($search_text) {
    //                 $q->where('first_name', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
    //             })
    //             ->orWhereHas('captain', function ($q) use ($search_text) {
    //                 $q->where('first_name', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
    //                 $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
    //             })
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(10);

    //         $trips->appends($request->all());


    //         // return response()->json(['trips' => $trips]);
    //         return View::make('dashboard.trips.categorized',  [
    //             'trips' => $trips,
    //             'admin' => $admin,
    //             'category' => $category,
    //             'category_name' => $category_name
    //         ]);
    //     }
    //     $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])
    //         ->orderBy('created_at', 'desc')->paginate(10);

    //     // return response()->json(['trips' => $trips]);
    //     return View::make('dashboard.trips.categorized',  [
    //         'trips' => $trips,
    //         'admin' => $admin,
    //         'category' => $category,
    //         'category_name' => $category_name
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function info($id)
    // {
    //     $notification = Trip::find($id);

    //     $notification->pickUp;
    //     $notification->dropOf;
    //     $notification->captain;
    //     $notification->user;


    //     return response()->json(['status' => 200, 'notification' => $notification]);
    // }
}
