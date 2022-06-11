<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AppToken;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $admin = $request->user()->first_name;
        $notifications = Notification::orderByRaw('updated_at - created_at DESC')->paginate(10);

        return view('dashboard.notifications.overview', [
            'notifications' => $notifications, 'admin' => $admin

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $admin_id =  $request->user()->id;

        $data = $request->all();

        $validator = Validator::make($data, [
            "title" => "required",
            "description" => "required",

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Notification::create([
            'admin_id' => $admin_id,
            'title' => $request->title,
            'description' => $request->description,

        ]);
        // return response()->json(['result' => 'works']);
        return redirect()->back()->with('Success', 'Notification Added successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = Notification::find($id);



        return response()->json(['status' => 200, 'notification' => $notification]);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);

        return response()->json(['status' => 200, 'notification' => $notification]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('_id');
        $notification = Notification::find($id);

        if ($notification) {
            $notification->update($request->all());
            return redirect()->back()->with('Warning', 'Update Successfully.');
        } else {

            return redirect()->back()->with('Error', 'No data Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {
        $id = $request->input('delete_notification_id');
        $admin = $request->user()->first_name;
        $notification = Notification::find($id);

        if ($notification) {
            $notification->delete();
            return redirect()->back()
                ->with(['Error' => 'Deleted Successfully.']);
        } else {
            return redirect()->back()
                ->with(['Error' => 'Record Faild to Deleted']);
            // return View::make('dashboard.admins.overview', ['admin' => $admin])
            //     ->with('Message', 'Record Faild to Deleted');
        }
    }


    /**
     * push notification to mobile app.
     *
     * @param  Response  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $notification_id = $request->input('notification_id');
        $notification = Notification::find($notification_id);
        $title = $notification->title;
        $body = $notification->description;
        $app_tokens = AppToken::all();


        foreach ($app_tokens as $token) {
            $this->send_notification_FCM($token->token, $title, $body);
        }

        return  redirect()->back()->with('Send', 'Notification sent successfully');
    }



    public function UserNotification(Request $request)
    {
        $id=$request->input('send_user_id');
        $user = User::find($id)->appToken;

        // dd($user->token);

        $title = $request->title;
        $description = $request->description;

        $this->send_notification_FCM($user->token, $title, $description);


        return  redirect()->back()->with('Send', 'Notification sent successfully');
    }


    public function search(Request $request)
    {
        $admin = $request->user()->first_name;
        $search_text = $request->input('search');


        if (isset($search_text)) {
            $notifications = Notification::where('title_en', 'LIKE', '%' . $search_text . '%')
                ->orWhere('title_ar', 'LIKE', '%' . $search_text . '%')
                ->orWhere('description_en', 'LIKE', '%' . $search_text . '%')
                ->orWhere('description_ar', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $notifications->appends($request->all());

            // return response()->json(['trips' => $trips]);
            return View::make('dashboard.notifications.overview',  ['notifications' => $notifications, 'admin' => $admin]);
        }
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['trips' => $trips]);
        return View::make('dashboard.notifications.overview',  ['notifications' => $notifications, 'admin' => $admin]);
    }





    /**
     * Return JSON response 
     * @param string $app_token
     * @param string $title
     * @param string $body
     * @return Response|JSON
     */

    function send_notification_FCM($app_token, $title, $body)
    {

        $SERVER_API_KEY = env('FCM_KEY');


        $data = [

            "registration_ids" => [
                $app_token
            ],

            "notification" => [

                "title" => $title,

                "body" => $body,

                "sound" => "default" // required for sound on ios

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return $response;
    }
}
