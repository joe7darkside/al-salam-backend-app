<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BillController extends Controller
{
    public function getMonthlyBills(Request $request)
    {
        $user_id = $request->user()->id;
        // $date = Carbon::parse($request->startFrom)->format('y-m');
        $monthly_bills = Bill::where('user_id', 'LIKE', $user_id)
            ->where('payment_status', 'LIKE', '%' . 0 . '%')
            ->get();
        $water_cast = 0;
        $gas_cast = 0;
        $electrec_cast = 0;
        $total_cost = 0;
        foreach ($monthly_bills as $key => $value) {

            if ($value->type == 0) {
                $electrec_cast = $value->price;
            } else if ($value->type == 1) {
                $gas_cast = $value->price;
            } else {
                $water_cast = $value->price;
            }
        }
        $total_cost = $electrec_cast + $gas_cast + $water_cast;


        return response()->json(['Monthly bills' => $monthly_bills, 'Total' => $total_cost, 'water' => $water_cast, 'gas' => $gas_cast, 'electrec' => $electrec_cast,]);
    }


    public function getUserBills(Request $request)
    {
        $user_id = $request->user()->id;

        
    }
}


// $myDate = '01/07/2020';
// $date = Carbon::createFromFormat('m/d/Y', $myDate);

// $monthName = $date->format('F');

// var_dump($monthName)