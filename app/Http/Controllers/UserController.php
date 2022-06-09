<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VisaCard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

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


    public function update(Request $request)
    {
        $user_id = $request->user()->id;

        $user = User::find($user_id);

        $user->update($request->all());

        return response(['Updated' => 'Information updatedd successfuly', 'statusCode' => 200],);
    }

    public function updateUser(Request $request)
    {
        $id = $request->input('user_edit_id');
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'phone' => 'digits:11|max:11',
            'email' => 'string|email|max:255',
            'unit' => '',
            'block' => '',
            'password' => 'string|min:8',
        ]);

        if ($user) {

            if ($validator->fails()) {
                redirect()->back()->with(['Error', $validator->errors()->toJson()]);            // return response()->json($validator->errors()->toJson(), 400);
            }
            $user->update(
                array_merge(
                    $validator->validated(),
                    [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'block' => $request->block,
                        'unit' => $request->unit,
                        'password' => Hash::make($request->password),
                    ]
                )

            );
            // $admin->update($request->all());
            return redirect()->back()->with('Warning', 'Update Successfully.');
        } else {

            return redirect()->back()->with('Error', 'No data Updated.');
        }
    }


    /**
     * Return Profile view with user object
     * @param Integer $id
     * @return View|Object 
     */

    public function userProfile($id, Request $request)
    {

        $admin_name = $request->user()->first_name;

        $user = User::find($id);

        $user->bill;

        $user->invitaion;

        $user->trip;

        return View::make('dashboard.users.profile', [
            'user' => $user, 'admin_name' => $admin_name
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

        return response()->json($user_cards);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('delete_user_id');
        $admin = $request->user()->first_name;
        $notification = User::find($id);

        if ($notification) {
            $notification->delete();
            return redirect()->route('users.overView')
                ->with(['Error' => 'User Deleted Successfully.']);
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


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {


        $validator = Validator::make($request->all(), [

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|digits:11|unique:users|max:11',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|max:255',
            'unit' => 'required|unique:users',
            'block' => 'required',
            'app_token' => '',

        ]);
        if ($validator->fails()) {
            response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        // $token = auth()->guard('api')->attempt($validator->validated());
        return redirect()->back()->with('Success', 'User successfully registered');
        // return response()->json([
        //     'message' => 'User successfully registered',
        //     'userToken' => $this->respondWithToken($token)
        // ], 200);
    }


    /**
     * Return profile view with user details
     * @param Request $request
     * @return View
     */

    public function editUser($id)
    {
        $user = User::find($id);

        // $trips = $user->trip;


        // return View::make('dashboard.users.profile',  ['user' => $user]);
        return response()->json(['status' => 200, 'user' => $user]);
    }
}
