<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\View;

class TripController extends Controller
{


    /**
     * Return overview view with array of trips form DB.
    
     * @return View|array
     */

    public function getTrips(Request $request)
    {
        $admin = $request->user()->first_name;

        $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json($trips);
        return View::make('dashboard.trips.overview', ['trips' => $trips, 'admin' => $admin]);
    }




    /**
     * Return specified trip with details
     * @param Int $id
     * @return Response|Json
     */

    public function show($id)
    {

        $trip = Trip::find($id);
        $trip->user;
        $trip->captain;
        $trip->pickUp;
        $trip->dropOf;

        return response()->json($trip);
    }

    /**
     * Return overview view with array of search results trips
    
     * @return View|array
     */

    public function search(Request $request)
    {
        $admin = $request->user()->first_name;
        $search_text = $request->input('search');

        // $user = User::with('Profile')->where('status', 1)->whereHas('Profile', function($q){
        //     $q->where('gender', 'Male');
        // })->get();


        if (isset($search_text)) {
            $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])
                ->where('cost', 'LIKE', '%' . $search_text . '%')
                ->orWhere('payment_method', 'LIKE', '%' . $search_text . '%')
                ->orWhereHas('user', function ($q) use ($search_text) {
                    $q->where('first_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
                })
                ->orWhereHas('captain', function ($q) use ($search_text) {
                    $q->where('first_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $trips->appends($request->all());

            return View::make('dashboard.trips.overview',  ['trips' => $trips, 'admin' => $admin]);
        }
        $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])->orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.trips.overview',  ['trips' => $trips, 'admin' => $admin]);
    }


    /**
     * Return categorized view with array of trips
    
     * @return View|array
     */

    public function categorizedTrips($category, Request $request)
    {
        $admin = $request->user()->first_name;

        $trips = Trip::where('status', 'LIKE', '%' . $category . '%')
            ->with(['user', 'captain', 'pickUp', 'dropOf'])
            ->orderBy('created_at', 'desc')->paginate(10);

        switch ($category) {
            case 1:
                $category_name = "Complete";
                break;
            case 0:
                $category_name = "Canceled";
                break;

            default:

                break;
        }

        return View::make('dashboard.trips.categorized', [
            'trips' => $trips,
            'category_name' => $category_name,
            'category' => $category,
            'admin' => $admin
        ]);
    }

    /**
     * Return categorized view with array of search results trips
    
     * @return View|array
     */

    public function categorizedSearch(Request $request, $category)
    {
        $search_text = $request->input('search');
        $admin = $request->user()->first_name;

        switch ($category) {
            case 1:
                $category_name = "Complete";
                break;
            case 0:
                $category_name = "Canceled";
                break;

            default:

                break;
        }


        if (isset($search_text)) {
            $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])
                ->where('status', 'LIKE', '%' . $category . '%')
                ->where('cost', 'LIKE', '%' . $search_text . '%')
                ->orWhereHas('user', function ($q) use ($search_text) {
                    $q->where('first_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
                })
                ->orWhereHas('captain', function ($q) use ($search_text) {
                    $q->where('first_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $trips->appends($request->all());


            // return response()->json(['trips' => $trips]);
            return View::make('dashboard.trips.categorized',  [
                'trips' => $trips,
                'admin' => $admin,
                'category' => $category,
                'category_name' => $category_name
            ]);
        }
        $trips = Trip::with(['user', 'captain', 'pickUp', 'dropOf'])
            ->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['trips' => $trips]);
        return View::make('dashboard.trips.categorized',  [
            'trips' => $trips,
            'admin' => $admin,
            'category' => $category,
            'category_name' => $category_name
        ]);
    }
}
