<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Captain;
use App\Models\Invitation;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $admin = $request->user()->first_name;

        $customers = User::all()->count();

        if ($customers >= 1000) {

            $customers = $customers / 1000 . "K";
        }

        $customers_latest = User::latest()->take(6)->get();

        $captains = Captain::all()->count();

        if ($captains >= 1000) {

            $captains = $captains / 1000 . "K";
        }
        $trips = Trip::all()->count();

        if ($trips >= 1000) {

            $trips = $trips / 1000 . "K";
        }
        $trips_latest = Trip::latest()->take(5)->get();

        $bills = Bill::all();

        $bills_cost = 0.0;

        foreach ($bills as $bill) {

            $bills_cost = $bills_cost + $bill->bill_cost;
        }

        if ($bills_cost >= 1000) {

            $bills_cost = $bills_cost / 1000 . "K";
        }

        $invitations = Invitation::all()->count();

        if ($invitations >= 1000) {

            $invitations = $invitations / 1000 . "K";
        }
        $invitation_latest = Invitation::latest()->take(5)->get();



        return View::make('dashboard.home.index', [
            'customers' => $customers,
            'captains' => $captains,
            'trips' => $trips,
            'invitations' => $invitations,
            'bills_cost' => $bills_cost,
            'customers_latest' => $customers_latest,
            'trips_latest' => $trips_latest,
            'invitation_latest' => $invitation_latest,
            'admin_name' => $admin,
        ]);
    }
}
