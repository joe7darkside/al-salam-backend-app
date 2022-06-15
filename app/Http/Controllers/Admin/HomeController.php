<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Captain;
use App\Models\Invitation;
use App\Models\Trip;
use App\Models\User;
use App\Models\WaterBill;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{



    /**
     * Get Home view with total data.
     *
     * @return \Illuminate\Http\View
     */
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

        $bills_table = $tables_data[0];
        // return response()->json($bills_table);
        $table_trip = $tables_data[1];
        $table_invitation = $tables_data[2];

        $chart_bills = $this->chartBills();

        return response()->json($chart_bills);

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
            'table_bills' => $bills_table,
            'table_trip' => $table_trip,
            'table_invitation' => $table_invitation
        ]);
    }



    public function chartBills()
    {

        $months = $this->monthFormat();

        $totalCost = 0;

        $bills = Bill::where('created_at', 'LIKE', '%' . '22-06' . '%')->get();
        foreach ($bills as $bill) {

            $totalCost = $totalCost + $bill->bill_cost;
            $monthlyBill[] = array('2022-11' => $totalCost);
        }

        return response($monthlyBill);
    }


    /**
     *  Return daily data update .
     *
     * @return \Illuminate\Http\View
     */
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



    /**
     * Return daily overview data .
     *
     * @return \Illuminate\Http\View
     */
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

    /**
     * Return tables total data.
     *
     * @return \Illuminate\Http\View
     */
    public function tablesData()
    {

        $bills = Bill::where('payment_status', 'LIKE', 1)->latest()->take(6)->get();

        $bills_table = array();
        foreach ($bills as $bill) {
            $bill->user;
            $bills_table[] = $bill;
        }

        $trips_table = Trip::latest()->take(5)->get();

        $invitation_table = Invitation::latest()->take(5)->get();

        return [
            $bills_table,
            $trips_table,
            $invitation_table
        ];
    }

    /**
     * Return array on months.
     *
     * @return \Illuminate\Http\View
     */
    public function monthFormat()
    {
        $monthsFormat = array();
        for ($i = 1; $i <= 12; $i++) {
            $months[] = '0' . $i;
        }
        foreach ($months as $month) {
            $monthsFormat[] = Carbon::today()->format('y-' . $month);
        }
        return $monthsFormat;
    }
}
