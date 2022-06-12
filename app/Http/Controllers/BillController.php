<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\ElectricityBill;
use App\Models\GasBill;
use App\Models\User;
use App\Models\WaterBill;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{

    // //? Fetch user monthly bills and return JSON response.
    // public function getMonthlyBills(Request $request)
    // {
    //     $user_id = $request->user()->id;

    //     $monthly_bills = Bill::where('user_id', 'LIKE', '%' . $user_id . '%')
    //         ->where('payment_status', 'LIKE', '%' . 0 . '%')
    //         ->with(['waterBill', 'gasBill', 'electricityBill'])->get();

    //     return response()->json(['Monthly Bills' => $monthly_bills]);
    // }




    /**
     * Remove the specified admin from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    // {

    //     $id = $request->input('delete_bill_id');
    //     // $admin = $request->user()->first_name;
    //     $bill = Bill::find($id);
    //     $water_bill = WaterBill::where('bill_id', 'LIKE', $id);
    //     $gas_bill = GasBill::where('bill_id', 'LIKE', $id);
    //     $electricity_bill = ElectricityBill::where('bill_id', 'LIKE', $id);


    //     if ($bill) {
    //         $bill->delete();
    //         $water_bill->delete();
    //         $gas_bill->delete();
    //         $electricity_bill->delete();
    //         return redirect()->back()
    //             ->with('Error', 'Bill Deleted successfully');
    //     } else {
    //         return redirect()->back()
    //             ->with('Error', 'Record Faild to Deleted');
    //     }
    // }
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

        return response()->json($user_bills);

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

    // public function addUserBill(Request $request)
    // {
    //     $data = $request->all();

    //     $validator = Validator::make($data, [
    //         "block" => "required",
    //         "unit" => "required",
    //         "payment_from" => "required",
    //         "payment_to" => "required",
    //         "water_bill" => "required|numeric",
    //         "gas_bill" => "required|numeric",
    //         "electricity_bill" => "required|numeric",
    //     ]);

    //     if ($validator->fails()) {
    //         redirect()->back()->with(['Error', $validator->errors()->toJson()]);
    //         // return response()->json($validator->errors()->toJson(), 400);
    //     }
    //     $date = Carbon::now();
    //     $monthName = $date->format('F');

    //     $bill_cost = $request->water_bill + $request->gas_bill + $request->electricity_bill;

    //     $user = User::where('block', 'LIKE', $request->block)
    //         ->where('unit', 'LIKE', $request->unit)->first();

    //     if (!$user) {
    //         return redirect()->back()->with('Error', "User not found!");
    //     }
    //     $bill = Bill::create(array_merge($validator->validated(), [
    //         "payment_from" => $request->payment_from,
    //         "payment_to" => $request->payment_to,
    //         "user_id" => $user->id,
    //         "payment_due" => $request->payment_to,
    //         "month_name" => $monthName,
    //         "bill_cost" => $bill_cost,
    //     ]));
    //     WaterBill::create(array_merge($validator->validated(), [
    //         "bill_id" => $bill->id,
    //         "cost" => $request->water_bill,

    //     ]));
    //     GasBill::create(array_merge($validator->validated(), [
    //         "bill_id" => $bill->id,
    //         "cost" => $request->gas_bill,

    //     ]));
    //     ElectricityBill::create(array_merge($validator->validated(), [
    //         "bill_id" => $bill->id,
    //         "cost" => $request->electricity_bill,

    //     ]));
    //     return redirect()->back()->with('Success', 'Bill Added successfully');
    // }



    // /**
    //  * Return overview view with array of bills
    //  * @param Request $request
    //  * @return View|array
    //  */

    // public function getBills(Request $request)
    // {
    //     $admin = $request->user()->first_name;
    //     $bills = Bill::orderBy('created_at', 'desc')->paginate(10);

    //     foreach ($bills as $key => $bill) {
    //         $bill->user;
    //         $bill->waterBill;
    //         $bill->gasBill;
    //         $bill->electricityBill;
    //     }

    //     // return response()->json(['bills' => $bills]);
    //     return View::make('dashboard.bills.overview', ['bills' => $bills, 'admin' => $admin]);
    // }

    // /**
    //  * Return categorizedBills view with array of categorized bills 
    //  * @param Request $request
    //  * @return View|array
    //  */

    // public function getCategorizedBills(Request $request, $category)
    // {
    //     $bills = Bill::orderBy('created_at', 'desc')->with($category)->paginate(10);

    //     // return response()->json(['bill' => $bills]);
    //     return View::make('dashboard.bills.categorized', ['bills' => $bills]);
    // }

    // /**
    //  * Return paymentStatuss view with array of categorized bills base on payment status
    //  * @param Request $request
    //  * @return View|array
    //  */

    // public function paymentStatusBills($status, Request $request)
    // {
    //     $admin = $request->user()->first_name;
    //     $bills =  Bill::where('payment_status', 'LIKE', '%' . $status . '%')
    //         ->with(['user', 'waterBill', 'gasBill', 'electricityBill'])
    //         ->paginate(10);

    //     if ($status == 1) {

    //         $status_name = "Paid";
    //     } else {
    //         $status_name = "Unpaid";
    //     }
    //     // return response()->json(['bills' => $bills, 'admin' => $admin]);
    //     return View::make('dashboard.bills.paymentStatus', [
    //         'bills' => $bills,
    //         'admin' => $admin,
    //         'status_name' => $status_name,
    //         'status' => $status
    //     ]);
    // }



    // /**
    //  * Return overview view with array search results of bills
    //  * @param Request $request
    //  * @return View|array
    //  */

    // public function search(Request $request)
    // {
    //     $admin = $request->user()->first_name;
    //     $search_text = $request->input('search');


    //     if (isset($search_text)) {
    //         $bills = Bill::where('Payment_date', 'LIKE', '%' . $search_text . '%')
    //             ->orWhere('bill_cost', 'LIKE', '%' . $search_text . '%')
    //             ->orWhere('month_name', 'LIKE', '%' . $search_text . '%')
    //             ->with(['user', 'waterBill', 'gasBill', 'electricityBill'])
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(10);

    //         $bills->appends($request->all());

    //         // return response()->json(['bill' => $bills]);
    //         return View::make('dashboard.bills.overview',  ['bills' => $bills, 'admin' => $admin]);
    //     }
    //     $bills =  Bill::orderBy('created_at', 'desc')->with(['user', 'waterBill', 'gasBill', 'electricityBill'])->paginate(10);

    //     // return response()->json(['bill' => $bills]);
    //     return View::make('dashboard.bills.overview',  ['bills' => $bills, 'admin' => $admin]);
    // }


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


    // /**
    //  * Return paymentStatus view with array search results of bills
    //  * @param Request $request
    //  * @return View|array
    //  */

    // public function statusSearch(Request $request, $paymentStatus)
    // {

    //     $status = $paymentStatus;
    //     $search_text = $request->input('search');
    //     $admin = $request->user()->first_name;
    //     if ($status == 1) {

    //         $status_name = "Paid";
    //     } else {
    //         $status_name = "Unpaid";
    //     }
    //     if (isset($search_text)) {
    //         $bills = Bill::where('payment_status', 'LIKE', '%' . $status . '%')
    //             ->where('Payment_date', 'LIKE', '%' . $search_text . '%')
    //             ->orWhere('bill_cost', 'LIKE', '%' . $search_text . '%')
    //             ->orWhere('month_name', 'LIKE', '%' . $search_text . '%')
    //             ->with(['user', 'waterBill', 'gasBill', 'electricityBill'])
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(10);

    //         $bills->appends($request->all());



    //         // return response()->json(['bill' => $bills]);
    //         return View::make('dashboard.bills.paymentStatus',  ['bills' => $bills, 'admin' => $admin, 'status' => $status, 'status_name' => $status_name]);
    //     }
    //     $bills =  Bill::where('payment_status', 'LIKE', '%' . $status . '%')->with(['user', 'waterBill', 'gasBill', 'electricityBill'])->paginate(10);

    //     // return response()->json(['bill' => $bills]);
    //     return View::make('dashboard.bills.paymentStatus',  ['bills' => $bills, 'admin' => $admin, 'status' => $status, 'status_name' => $status_name]);
    // }




    // /**
    //  * Return profile view with captain details
    //  * @param Request $request
    //  * @return View
    //  */

    // public function editBill($id)
    // {

    //     $bill = Bill::find($id);
    //     // $bill->user;
    //     $bill->waterBill;
    //     $bill->gasBill;
    //     $bill->electricityBill;

    //     return response()->json($bill);
    // }



    // /**
    //  * Return profile view with captain details
    //  * @param Request $request
    //  * @return View
    //  */

    // public function updateBill(Request $request)
    // {


    //     $id = $request->input('bill_id');

    //     $bill = Bill::find($id);

    //     $bill_water_id = $bill->waterBill->id;
    //     $bill_gas_id = $bill->gasBill->id;
    //     $bill_electricity_id = $bill->electricityBill->id;

    //     $validator = Validator::make($request->all(), [

    //         "water_bill" => "numeric",
    //         "gas_bill" => "numeric",
    //         "electricity_bill" => "numeric",

    //         // "payment_due" => "string",
    //         // "water_bill" => "numeric",
    //         // "gas_bill" => "numeric",
    //         // "electricity_bill" => "numeric",


    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->with(['message', $validator->errors()->toJson()]);
    //         // return response()->json($validator->errors()->toJson(), 400);
    //     }

    //     if ($bill) {

    //         $bill_cost = $request->water_bill + $request->gas_bill + $request->electricity_bill;

    //         $bill->update([
    //             'payment_from' => $request->payment_from,
    //             'payment_to' => $request->payment_to,
    //             'bill_cost' => $bill_cost,
    //         ]);

    //         WaterBill::where('id', $bill_water_id)
    //             ->update([
    //                 'cost' => $request->water_bill,
    //             ]);

    //         GasBill::where('id', $bill_gas_id)
    //             ->update([
    //                 'cost' => $request->gas_bill,
    //             ]);

    //         ElectricityBill::where('id', $bill_electricity_id)
    //             ->update([
    //                 'cost' => $request->electricity_bill,
    //             ]);

    //         return redirect()->back()->with('Warning', 'Update Successfully.');
    //         // return response()->json(['Success' => 'Update Successfully.']);
    //     } else {
    //         // return response()->json(['Warning' => 'No data Updated.']);

    //         return redirect()->back()->with('Warning', 'No data Updated.');
    //     }
    //     // return response()->json(['status' => 200, 'bill' => $bill]);
    // }
}
