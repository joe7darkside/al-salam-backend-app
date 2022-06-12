<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bill;

class BillController extends Controller
{
    /**
     * Return array of user's bills
     * @param Request $request
     * @return Array|JSON
     * 
     */

    public function getUserBills(Request $request)
    {
        $user_id = $request->user()->id;

        $user_bills = Bill::where('user_id', 'LIKE', '%' . $user_id . '%')
            ->with(['waterBill', 'gasBill', 'electricityBill'])->get();

        return response()->json($user_bills);
    }
}
