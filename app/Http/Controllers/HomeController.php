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

        // Admin name
        $admin = $request->user()->first_name;


        // Format date
        $today = Carbon::today()->format('y-m-d');

        // Get Daily data update
        $daily_update = $this->dailyUpdate($today);
        $bill = $daily_update[0];
        $customer = $daily_update[1];
        $trip = $daily_update[2];
        $invitation = $daily_update[3];

        // Get overview data 
        $overview_data = $this->overviewData();

        $overview_bill = $overview_data[0];
        $overview_customer = $overview_data[1];
        $overview_captains = $overview_data[2];
        $overview_trip = $overview_data[3];
        $overview_invitation = $overview_data[4];


        // Get data tables
        $tables_data = $this->tablesData();

        $table_customer = $tables_data[0];
        $table_trip = $tables_data[1];
        $table_invitation = $tables_data[2];

        $monthly_bills = $this->totalMonthlyBills();
        return response()->json(['Results' => $monthly_bills]);


        return View::make('dashboard.home.index', [
            'admin_name' => $admin,
            'new_customers' => $customer,
            'new_trips' => $trip,
            'new_invitations' => $invitation,
            'new_bills' => $bill,
            'overview_bill' => $overview_bill,
            'overview_customer' => $overview_customer,
            'overview_trip' => $overview_trip,
            'overview_invitation' => $overview_invitation,
            'overview_captains' => $overview_captains,
            'table_customer' => $table_customer,
            'table_trip' => $table_trip,
            'table_invitation' => $table_invitation
        ]);
    }



    public function waterBills()
    {
        $monthsFormat = $this->monthFormat();
        $water_bills = array();
        $water_bill_cost = 0.0;
        foreach ($monthsFormat as $month) {
            $water_bills[] = WaterBill::where('created_at', 'LIKE', '%' . $month . '%')->get(['cost']);
        }
        return  $water_bills;
        foreach ($water_bills as $bill) {
            // $water_bill_cost = $bill;
            return  $bill;
        }



        // return response(['new_bills' => $new_bills]);
    }


    public function totalMonthlyBills()
    {
        $bills_per_month = array();
        $monthFormat = $this->monthFormat();
        foreach ($monthFormat as  $month) {
            $bills_per_month = array_merge($bills_per_month, Bill::where('created_at', 'LIKE', '%' . $month . '%')
                ->get());
        }
        $c = count($bills_per_month);
        for ($i = 0; $i < $c; $i++)
            echo $bills_per_month[$i];

        // $bills_per_month=$bills_per_month;
        // dd($bills_per_month[1]);
        // foreach ($monthsFormat as  $month) {
        // $bills_per_month[] = Bill::where('created_at', 'LIKE', '%' . $month . '%')
        //     ->get(['bill_cost']);
        // return  $month;
        // if ($bills_per_month->created_at == $month) {
        //     $total_billsPre_month[] = $bills_per_month->bill_cost;
        // }
        // }

        // return  $bills_per_month;
    }


    public function monthFormat()
    {
        $monthsFormat = array();
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        foreach ($months as $month) {
            $monthsFormat[] = Carbon::today()->format('y-' . $month);
        }
        return $monthsFormat;
    }



    public function dailyUpdate($date)
    {


        $new_customers_count = User::where('created_at', 'LIKE', '%' . $date . '%')->get()->count();

        $new_trips_count = Trip::where('created_at', 'LIKE', '%' . $date . '%')->get()->count();

        $new_invitations_count = Invitation::where('created_at', 'LIKE', '%' . $date . '%')->get()->count();

        $new_bills = Bill::where('created_at', 'LIKE', '%' . $date . '%')->get();

        $new_bills_cost = 0.0;

        foreach ($new_bills as $new_bill) {

            $new_bills_cost = $new_bills_cost + $new_bill->bill_cost;
        }

        if ($new_bills_cost >= 1000) {

            $new_bills_cost = $new_bills_cost / 1000 . "K";
        }

        return [
            $new_bills_cost,
            $new_customers_count,
            $new_trips_count,
            $new_invitations_count,

        ];
    }


    public function overviewData()
    {

        $customers = User::all()->count();

        $captains = Captain::all()->count();

        $trips = Trip::all()->count();

        $invitations = Invitation::all()->count();

        $bills = Bill::all();

        $bills_cost = 0.0;

        foreach ($bills as $bill) {

            $bills_cost = $bills_cost + $bill->bill_cost;
        }

        if ($bills_cost >= 1000) {

            $bills_cost = $bills_cost / 1000 . "K";
        }


        if ($customers >= 1000) {

            $customers = $customers / 1000 . "K";
        }

        if ($captains >= 1000) {

            $captains = $captains / 1000 . "K";
        }

        if ($trips >= 1000) {

            $trips = $trips / 1000 . "K";
        }

        if ($invitations >= 1000) {

            $invitations = $invitations / 1000 . "K";
        }

        return [
            $bills_cost,
            $customers,
            $captains,
            $trips,
            $invitations
        ];
    }

    public function tablesData()
    {

        $customers_table = User::latest()->take(6)->get();

        $trips_table = Trip::latest()->take(5)->get();

        $invitation_table = Invitation::latest()->take(5)->get();

        return [
            $customers_table,
            $trips_table,
            $invitation_table
        ];
    }
}
