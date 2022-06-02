<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Captain;
use App\Models\Invitation;
use App\Models\Trip;
use App\Models\User;
use App\Models\WaterBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $admin = $request->user()->first_name;

        $today = Carbon::today()->format('y-m-d');



        $billsPerMonth = $this->billPerMonth();

        return response(['results' => $billsPerMonth]);


        $new_customers_count = User::where('created_at', 'LIKE', '%' . $today . '%')->get()->count();

        $new_trips_count = Trip::where('created_at', 'LIKE', '%' . $today . '%')->get()->count();

        $new_invitations_count = Invitation::where('created_at', 'LIKE', '%' . $today . '%')->get()->count();

        $new_bills = Bill::where('created_at', 'LIKE', '%' . $today . '%')->get();

        $new_bills_cost = 0.0;

        foreach ($new_bills as $new_bill) {

            $new_bills_cost = $new_bills_cost + $new_bill->bill_cost;
        }

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

        if ($bills_cost >= 1000 || $new_bills_cost >= 1000) {

            $new_bills_cost = $new_bills_cost / 1000 . "K";
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
            'new_customers' => $new_customers_count,
            'new_trips' => $new_trips_count,
            'new_invitations' => $new_invitations_count,
            'new_bills' => $new_bills_cost,
            'admin_name' => $admin,
        ]);
    }



    public function billPerMonth()
    {

        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        $bill_months = array();
        foreach ($months as $month) {
            $bill_months[] = Carbon::today()->format('y-' . $month);
        }
        // return $bill_months;
        $water_bills = array();
        $water_bill_cost = 0.0;
        foreach ($bill_months as $bill_month) {
            $water_bills[] = WaterBill::where('created_at', 'LIKE', '%' . $bill_month . '%')->get();
            $water_bill_cost
        }

        return  $water_bills;
        // return response(['new_bills' => $new_bills]);
    }
}
