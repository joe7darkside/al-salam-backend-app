<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{


    /**
     * Return overview view with array of users
     * @param Request $request
     * @return View|array
     */

    public function getUsers(Request $request)
    {
        // $admin = $request->user()->first_name;
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.users.overview', ['users' => $users,]);
    }


    /**
     * Return overview view with array search results of users
     * @param Request $request
     * @return View|array
     */

    public function search(Request $request)
    {
        $search_text = $request->input('search');

        if (isset($search_text)) {
            $users = User::where('first_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('email', 'LIKE', '%' . $search_text . '%')
                ->orWhere('phone', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $users->appends($request->all());

            return View::make('dashboard.users.overview', ['users' => $users]);
        }
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.users.overview', ['users' => $users]);
    }



    /**
     * Return Profile view with user object
     * @param Integer $id
     * @return View|Object 
     */

    public function userProfile($id)
    {

        $user = User::find($id);

        $bills = $user->bill;
        foreach ($bills as $key => $bill) {
            $waterBill =  $bill->waterBill;
            $gasBill = $bill->gasBill;
            $electricityBill = $bill->electricityBill;
            $total = $waterBill ;
        }

        $user->invitaion;

        $user->trip;

        return response()->json(['user' => $user, 'rule' => 'Customer', 'total' => $total]);
        // return View::make('dashboard.users.profile', [
        //     'user' => $user, 'rule' => 'Customer', 'total' => $total

        // ]);
    }




    /**
     * Send notification & return Profile view 
     * @param Integer $id
     * @param Request $request
     * @return View|Response
     */

    public function sendNotification(Request $request, $id)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::find($id);

        $user_app_token = $user->app_token;

        send_notification_FCM($user_app_token, $request->title, $request->body);

        return  redirect()->back()->with('sussess', 'Notification sent successfully');
    }


    /**
     * Return a json response of the user information
     * @param Request $request
     * @return array
     */

    public function getUserInfo(Request $request)
    {
        $user = $request->user();


        return response()->json(['User' => $user]);
    }

    /**
     * Return a json response of the user visa cards
     * @param Request $request
     * @return array
     */
    public function getVisaCard(Request $request)
    {
        $user_id = $request->user()->id;
        $user_cards = User::find($user_id)->VisaCard;

        return response()->json(['User Cards' => $user_cards]);
    }
}
