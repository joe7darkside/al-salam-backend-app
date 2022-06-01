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
        $admin = $request->user()->first_name;
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.users.overview', ['users' => $users, 'admin' => $admin]);
    }


    /**
     * Return overview view with array search results of users
     * @param Request $request
     * @return View|array
     */

    public function search(Request $request)
    {
        $search_text = $request->input('search');

        $admin = $request->user()->first_name;

        if (isset($search_text)) {
            $users = User::where('first_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('email', 'LIKE', '%' . $search_text . '%')
                ->orWhere('phone', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $users->appends($request->all());

            return View::make('dashboard.users.overview', ['users' => $users, 'admin' => $admin]);
        }
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.users.overview', ['users' => $users, 'admin' => $admin]);
    }



    /**
     * Return Profile view with user object
     * @param Integer $id
     * @return View|Object 
     */

    public function userProfile($id)
    {

        $user_trips = array();
        $captains = array();
        $user = User::find($id);

        $user->bill;

        $user->invitaion;

        $trips =  $user->trip;

        // foreach ($trips as $key => $trip) {

        //     $user_trips[] = $trip;
        // }

        // foreach ($trips as $key => $trip) {

        //     $trip_captain = Captain::where('id', 'LIKE', '%' . $trip->trip_captain . '%');
        //     $captains[] = $trip_captain;
        // }



        // foreach ($bills as $key => $bill) {
        //     $waterBill =  $bill->waterBill;
        //     $gasBill = $bill->gasBill;
        //     $electricityBill = $bill->electricityBill;
        // }

        // return response()->json([
        //     'user' => $user,
        // ]);
        return View::make('dashboard.users.profile', [
            'user' => $user,
        ]);
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



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        $id = $request->input('delete_user_id');
        $admin = $request->user()->first_name;
        $notification = User::find($id);

        if ($notification) {
            $notification->delete();
            return redirect()->route('users.overView')
                ->with(['Success' => 'User Deleted Successfully.']);
        } else {
            return redirect()->back()
                ->with(['Error' => 'Record Faild to Deleted']);
            // return View::make('dashboard.admins.overview', ['admin' => $admin])
            //     ->with('Message', 'Record Faild to Deleted');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $id = $request->input('send_user_id');
        $user = User::find($id);

        if ($user) {
            // $admin->update($request->all());
            return redirect()->back()->with('Send', 'Message sent Successfully.');
        } else {

            return redirect()->back()->with('Error', 'No data sent.');
        }
    }
}
