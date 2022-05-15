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

        // $User_bills = Bill::find($user_id)->where('payment_status', 'LIKE', '%' . 0 . '%');
        $User_bills = Bill::where('payment_status', 'LIKE', '%' . 0 . '%')->waterBill->get();

        // $bill = $User_bills->first();
        // $bill->waterBill;
        // $bill->gasBill;
        // $bill->electricityBill;
        // foreach ($User_bills as $key => $bill) {

        //     $bill->waterBill;
        //     $bill->gasBill;
        //     $bill->electricityBill;
        // }
        // $water_bill = Bill::find();

        return response()->json(['bills' => $User_bills]);
        //    $n= User::whereHas('waterBill', function ($query) {
        //         return $query->where('user_id', '=', $query->id);
        //     })->get();
        //     return response()->json(['n'=>$n]);
        // $date = Carbon::parse($request->startFrom)->format('y-m');
        // $monthly_bills =
        // Bill::with('waterBill')->all();
        // where('payment_status', 'LIKE', '%' . 0 . '%')
        // ->get();
        //     $monthly_bills=$monthly_bills->find($user_id);
        // $water_bill = $monthly_bills->waterBill;
        // return response()->json(['monthly_bills' => $monthly_bills]);
        // $water_cast = 0;
        // $gas_cast = 0;
        // $electrec_cast = 0;
        // $total_cost = 0;
        // foreach ($monthly_bills as $key => $value) {

        //     if ($value->type == 0) {
        //         $electrec_cast = $value->price;
        //     } else if ($value->type == 1) {
        //         $gas_cast = $value->price;
        //     } else {
        //         $water_cast = $value->price;
        //     }
        // }
        // $total_cost = $electrec_cast + $gas_cast + $water_cast;


        // return response()->json([
        //     'Monthly bills' => $monthly_bills,
        //     'Total' => $total_cost,
        //     'water' => $water_cast,
        //     'gas' => $gas_cast,
        //     'electrec' => $electrec_cast,
        // ]);
    }


    public function getUserBills(Request $request)
    {
        $user_id = $request->user()->id;

        $user_bills = User::find($user_id)->bill;

        $months_name = array();
        foreach ($user_bills as $key => $bill) {


            $monthName = $bill->created_at->format("F");
            $months_name[] = $monthName;
        }


        return response()->json(['User bills' => $user_bills, 'Months name' => $months_name]);
    }

    public function addUserBill(Request $request)
    {
        $user_id = $request->user()->id;

        $date = Carbon::now();
        $monthName = $date->format('F');

        $bill = Bill::create([
            "user_id" => $user_id,
            "type" => $request->type,
            "Payment_date" => $request->Payment_date,
            "month_name" => $monthName,
            "payment_status" => $request->payment_status,
            "cost" => $request->cost,
        ]);

        return response()->json(['New bill' => $bill]);
        # code...
    }
}
