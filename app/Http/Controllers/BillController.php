<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\ElectricityBill;
use App\Models\GasBill;
use App\Models\User;
use App\Models\WaterBill;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{

    //? Fetch user monthly bills and return JSON response.
    public function getMonthlyBills(Request $request)
    {
        $user_id = $request->user()->id;

        $monthly_bills = Bill::where('user_id', 'LIKE', '%' . $user_id . '%')
            ->where('payment_status', 'LIKE', '%' . 0 . '%')
            ->with(['waterBill', 'gasBill', 'electricityBill'])->get();

        return response()->json(['Monthly Bills' => $monthly_bills]);
    }




    /**
     * Remove the specified admin from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $admin = $request->user()->first_name;
        $bill = Bill::find($id);

        if ($bill) {
            $bill->delete();
            return redirect()->back()
                ->with(['Message' => 'Deleted Successfully.', 'admin' => $admin]);
        } else {
            return redirect()->back()
                ->with(['Message' => 'Record Faild to Deleted', 'admin' => $admin]);
        }
    }
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


    /**
     * Return array of user's bills
     * @param Request $request
     * @return array
     */

    public function getUserBills(Request $request)
    {
        $user_id = $request->user()->id;

        $user_bills = Bill::where('user_id', 'LIKE', '%' . $user_id . '%')
            ->with(['waterBill', 'gasBill', 'electricityBill'])->get();

        return response()->json(['User bills' => $user_bills]);

        // $user_bills = User::find($user_id)->bill;
        // $months_name = array();
        // foreach ($user_bills as $key => $bill) {


        //     $monthName = $bill->created_at->format("F");
        //     $months_name[] = $monthName;
        // }

    }

    // /**
    //  * Return overview view with array of users
    //  * @param Request $request
    //  * @return View|array
    //  */

    public function addUserBill(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            "user_id" => "required",
            "Payment_date" => "required",
            "month_name" => "required",
            "payment_status" => "required",
            "water_bill" => "required",
            "gas_bill" => "required",
            "electricity_bill" => "required",


        ]);
        $user_id = $request->user()->id;

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $date = Carbon::now();
        $monthName = $date->format('F');

        $bill_cost = $request->water_bill + $request->gas_bill + $request->electricity_bill;
        $bill = Bill::create([
            "user_id" => $request->user_id,
            "Payment_date" => $request->Payment_date,
            "month_name" => $monthName,
            "payment_status" => $request->payment_status,
            "bill_cost" => $bill_cost,
        ]);

        $waterBill = WaterBill::create([
            "bill_id" => $bill->id,
            "cost" => $request->water_bill,

        ]);

        $gasBill = GasBill::create([
            "bill_id" => $bill->id,
            "cost" => $request->gas_bill,

        ]);
        $electricityBill = ElectricityBill::create([
            "bill_id" => $bill->id,
            "cost" => $request->electricity_bill,

        ]);
        return redirect()->back();
        // return response()->json(['New bill' => $bill]);
    }



    /**
     * Return overview view with array of bills
     * @param Request $request
     * @return View|array
     */

    public function getBills(Request $request)
    {
        $admin = $request->user()->first_name;
        $bills = Bill::orderBy('created_at', 'desc')->paginate(10);

        foreach ($bills as $key => $bill) {
            $bill->user;
            $bill->waterBill;
            $bill->gasBill;
            $bill->electricityBill;
        }

        // return response()->json(['bills' => $bills]);
        return View::make('dashboard.bills.overview', ['bills' => $bills, 'admin' => $admin]);
    }

    /**
     * Return categorizedBills view with array of categorized bills 
     * @param Request $request
     * @return View|array
     */

    public function getCategorizedBills(Request $request, $category)
    {
        $bills = Bill::orderBy('created_at', 'desc')->with($category)->paginate(10);

        // return response()->json(['bill' => $bills]);
        return View::make('dashboard.bills.categorized', ['bills' => $bills]);
    }

    /**
     * Return paymentStatuss view with array of categorized bills base on payment status
     * @param Request $request
     * @return View|array
     */

    public function paymentStatusBills($status, Request $request)
    {
        $admin = $request->user()->first_name;
        $bills =  Bill::where('payment_status', 'LIKE', '%' . $status . '%')
            ->with(['user', 'waterBill', 'gasBill', 'electricityBill'])
            ->paginate(10);

        if ($status == 1) {

            $status_name = "Paid";
        } else {
            $status_name = "Unpaid";
        }
        // return response()->json(['bills' => $bills, 'admin' => $admin]);
        return View::make('dashboard.bills.paymentStatus', [
            'bills' => $bills,
            'admin' => $admin,
            'status_name' => $status_name,
            'status' => $status
        ]);
    }



    /**
     * Return overview view with array search results of bills
     * @param Request $request
     * @return View|array
     */

    public function search(Request $request)
    {
        $admin = $request->user()->first_name;
        $search_text = $request->input('search');


        if (isset($search_text)) {
            $bills = Bill::where('Payment_date', 'LIKE', '%' . $search_text . '%')
                ->orWhere('bill_cost', 'LIKE', '%' . $search_text . '%')
                ->orWhere('month_name', 'LIKE', '%' . $search_text . '%')
                ->with(['user', 'waterBill', 'gasBill', 'electricityBill'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $bills->appends($request->all());

            // return response()->json(['bill' => $bills]);
            return View::make('dashboard.bills.overview',  ['bills' => $bills, 'admin' => $admin]);
        }
        $bills =  Bill::orderBy('created_at', 'desc')->with(['user', 'waterBill', 'gasBill', 'electricityBill'])->paginate(10);

        // return response()->json(['bill' => $bills]);
        return View::make('dashboard.bills.overview',  ['bills' => $bills, 'admin' => $admin]);
    }


    // /**
    //  * Return categorized view with array search results of bills
    //  * @param Request $request
    //  * @return View|array
    //  */

    // public function categorizedSearch(Request $request, $category)
    // {

    //     $search_text = $request->input('search');


    //     if (isset($search_text)) {
    //         $bills = Bill::where('Payment_date', 'LIKE', '%' . $search_text . '%')
    //             ->orWhere('month_name', 'LIKE', '%' . $search_text . '%')
    //             ->with($category)
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(10);

    //         $bills->appends($request->all());

    //         // return response()->json(['bill' => $bills]);
    //         return View::make('dashboard.users.paymentStatus',  ['bills' => $bills]);
    //     }
    //     $bills =  Bill::with($category)->orderBy('created_at', 'desc')->paginate(10);

    //     // return response()->json(['bill' => $bills]);
    //     return View::make('dashboard.bills.paymentStatus',  ['bills' => $bills]);
    // }


    /**
     * Return paymentStatus view with array search results of bills
     * @param Request $request
     * @return View|array
     */

    public function statusSearch(Request $request, $paymentStatus)
    {

        $status = $paymentStatus;
        $search_text = $request->input('search');
        $admin = $request->user()->first_name;
        if ($status == 1) {

            $status_name = "Paid";
        } else {
            $status_name = "Unpaid";
        }
        if (isset($search_text)) {
            $bills = Bill::where('payment_status', 'LIKE', '%' . $status . '%')
                ->where('Payment_date', 'LIKE', '%' . $search_text . '%')
                ->orWhere('bill_cost', 'LIKE', '%' . $search_text . '%')
                ->orWhere('month_name', 'LIKE', '%' . $search_text . '%')
                ->with(['user', 'waterBill', 'gasBill', 'electricityBill'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $bills->appends($request->all());



            // return response()->json(['bill' => $bills]);
            return View::make('dashboard.bills.paymentStatus',  ['bills' => $bills, 'admin' => $admin, 'status' => $status, 'status_name' => $status_name]);
        }
        $bills =  Bill::where('payment_status', 'LIKE', '%' . $status . '%')->with(['user', 'waterBill', 'gasBill', 'electricityBill'])->paginate(10);

        // return response()->json(['bill' => $bills]);
        return View::make('dashboard.bills.paymentStatus',  ['bills' => $bills, 'admin' => $admin, 'status' => $status, 'status_name' => $status_name]);
    }
}
