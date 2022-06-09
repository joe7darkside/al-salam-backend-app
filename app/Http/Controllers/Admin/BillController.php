<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\ElectricityBill;
use App\Models\GasBill;
use App\Models\User;
use App\Models\WaterBill;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    /**
     * Delete the specified bill from DB.
     *
     * @param  Request  $request
     * @return Redirect
     */
    public function destroy(Request $request)
    {

        $id = $request->input('delete_bill_id');

        $bill = Bill::find($id);

        $water_bill = WaterBill::where('bill_id', 'LIKE', $id)->first();

        $gas_bill = GasBill::where('bill_id', 'LIKE', $id)->first();

        $electricity_bill = ElectricityBill::where('bill_id', 'LIKE', $id)->first();

        if ($bill) {
            $bill->delete();
            $water_bill->delete();
            $gas_bill->delete();
            $electricity_bill->delete();
            return redirect()->back()
                ->with('Error', 'Bill Deleted Successfully');
        } else {
            return redirect()->back()
                ->with('Error', 'Record Faild to Deleted');
        }
    }

    /**
     * Add new bill to DB.
     *
     * @param  Request  $request
     * @return Redirect
     */
    public function add(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            "block" => "required",
            "unit" => "required",
            "payment_from" => "required",
            "payment_to" => "required",
            "water_bill" => "required|numeric",
            "gas_bill" => "required|numeric",
            "electricity_bill" => "required|numeric",
        ]);

        if ($validator->fails()) {
            redirect()->back()->with(['Error', $validator->errors()->toJson()]);
        }

        $date = Carbon::now();
        $monthName = $date->format('F');

        $bill_cost = $request->water_bill + $request->gas_bill + $request->electricity_bill;

        $user = User::where('block', 'LIKE', $request->block)
            ->where('unit', 'LIKE', $request->unit)->first();

        if (!$user) {
            return redirect()->back()->with('Error', "User not found!");
        }

        $bill = Bill::create(array_merge($validator->validated(), [
            "payment_from" => $request->payment_from,
            "payment_to" => $request->payment_to,
            "user_id" => $user->id,
            "payment_due" => $request->payment_to,
            "month_name" => $monthName,
            "bill_cost" => $bill_cost,
        ]));
        WaterBill::create(array_merge($validator->validated(), [
            "bill_id" => $bill->id,
            "cost" => $request->water_bill,

        ]));
        GasBill::create(array_merge($validator->validated(), [
            "bill_id" => $bill->id,
            "cost" => $request->gas_bill,

        ]));
        ElectricityBill::create(array_merge($validator->validated(), [
            "bill_id" => $bill->id,
            "cost" => $request->electricity_bill,

        ]));
        return redirect()->back()->with('Success', 'Bill Added Successfully');
    }


    /**
     * Update bill in DB
     * @param Request $request
     * @return Redirect
     */

    public function update(Request $request)
    {


        $id = $request->input('bill_id');

        $bill = Bill::find($id);

        $bill_water_id = $bill->waterBill->id;

        $bill_gas_id = $bill->gasBill->id;

        $bill_electricity_id = $bill->electricityBill->id;

        $validator = Validator::make($request->all(), [

            "water_bill" => "numeric",
            "gas_bill" => "numeric",
            "electricity_bill" => "numeric"
        ]);

        if ($validator->fails()) {
            redirect()->back()->with(['message', $validator->errors()->toJson()]);
        }

        if ($bill) {

            $bill_cost = $request->water_bill + $request->gas_bill + $request->electricity_bill;

            $bill->update([
                'payment_from' => $request->payment_from,
                'payment_to' => $request->payment_to,
                'bill_cost' => $bill_cost,
            ]);

            WaterBill::where('id', $bill_water_id)
                ->update([
                    'cost' => $request->water_bill,
                ]);

            GasBill::where('id', $bill_gas_id)
                ->update([
                    'cost' => $request->gas_bill,
                ]);

            ElectricityBill::where('id', $bill_electricity_id)
                ->update([
                    'cost' => $request->electricity_bill,
                ]);

            return redirect()->back()->with('Warning', 'Update Successfully.');
        }
        return redirect()->back()->with('Warning', 'No data Updated.');
    }


    /**
     * Return specified bill with details
     * @param Int $id
     * @return Response|Json
     */

    public function edit($id)
    {

        $bill = Bill::find($id);
        $bill->waterBill;

        $bill->gasBill;

        $bill->electricityBill;

        return response()->json($bill);
    }

    /**
     * Return View with array of bills
     * @param Request $request
     * @return View|array
     */

    public function get(Request $request)
    {
        $admin = $request->user()->first_name;

        $bills = Bill::orderBy('created_at', 'desc')->paginate(10);

        foreach ($bills as $bill) {

            $bill->user;

            $bill->waterBill;

            $bill->gasBill;

            $bill->electricityBill;
        }

        return View::make('dashboard.bills.overview', ['bills' => $bills, 'admin' => $admin]);
    }

    /**
     * Return specific user's bills
     * @param Request $request
     * @return Response|Json
     */

    public function getUserBills(Request $request)
    {
        $user_id = $request->user()->id;

        $user_bills = Bill::where('user_id', 'LIKE', '%' . $user_id . '%')
            ->with(['waterBill', 'gasBill', 'electricityBill'])
            ->get();

        return response()->json($user_bills);
    }


    /**
     * Return specific user's bills per month
     * @param Request $request
     * @return Response|Json
     */
    public function getPerMonth(Request $request)
    {
        $user_id = $request->user()->id;

        $monthly_bills = Bill::where('user_id', 'LIKE', '%' . $user_id . '%')
            ->where('payment_status', 'LIKE', '%' . 0 . '%')
            ->with(['waterBill', 'gasBill', 'electricityBill'])->get();

        return response()->json($monthly_bills);
    }


    /**
     * Return categorized Bills view with array of categorized bills 
     * @param Request $request
     * @return View|array
     */

    public function getCategorized($category)
    {
        $bills = Bill::orderBy('created_at', 'desc')->with($category)->paginate(10);

        return View::make('dashboard.bills.categorized', ['bills' => $bills]);
    }

    /**
     * Return paymentStatus view with array of categorized bills base on payment status
     * @param Request $request
     * @return View|array
     */

    public function getPaymentStatusBills($status, Request $request)
    {
        $admin = $request->user()->first_name;

        $bills =  Bill::where('payment_status', 'LIKE', '%' . $status . '%')
            ->with(['user', 'waterBill', 'gasBill', 'electricityBill'])
            ->paginate(10);

        switch ($status) {
            case 1:
                $status_name = "Paid";
                break;
            case 0:
                $status_name = "Unpaid";
                break;

            default:

                break;
        }

        return View::make('dashboard.bills.paymentStatus', [
            'bills' => $bills,
            'admin' => $admin,
            'status_name' => $status_name,
            'status' => $status
        ]);
    }


    /**
     * Return overview view with search results of bills
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

            return View::make('dashboard.bills.overview',  ['bills' => $bills, 'admin' => $admin]);
        }
        $bills =  Bill::orderBy('created_at', 'desc')->with(['user', 'waterBill', 'gasBill', 'electricityBill'])->paginate(10);

        return View::make('dashboard.bills.overview',  ['bills' => $bills, 'admin' => $admin]);
    }


    /**
     * Return paymentStatus view with search results of bills 
     * @param Request $request
     * @return View|array
     */

    public function statusSearch(Request $request, $paymentStatus)
    {

        $status = $paymentStatus;
        $search_text = $request->input('search');
        $admin = $request->user()->first_name;

        switch ($status) {
            case 1:
                $status_name = "Paid";
                break;
            case 0:
                $status_name = "Unpaid";
                break;

            default:

                break;
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

            return View::make('dashboard.bills.paymentStatus',  ['bills' => $bills, 'admin' => $admin, 'status' => $status, 'status_name' => $status_name]);
        }
        $bills =  Bill::where('payment_status', 'LIKE', '%' . $status . '%')->with(['user', 'waterBill', 'gasBill', 'electricityBill'])->paginate(10);

        return View::make('dashboard.bills.paymentStatus',  ['bills' => $bills, 'admin' => $admin, 'status' => $status, 'status_name' => $status_name]);
    }
}
