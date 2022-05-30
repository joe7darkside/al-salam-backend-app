<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
            "title_en" => "required",
            "title_ar" => "required",
            "description_en" => "required",
            "description_ar" => "required",

        ]);
        if ($validator->fails()) {
            return redirect()->back()->with(['message', $validator->errors()->toJson()]);
            // return response()->json($validator->errors()->toJson(), 400);
        }

        Notification::create([
            'admin_id' => $admin_id,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,

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
            return redirect()->back()->with('Success', 'Update Successfully.');
        } else {

            return redirect()->back()->with('Warning', 'No data Updated.');
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
                ->with(['Success' => 'Deleted Successfully.']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $notification_id = $request->input('notification_id');
        $notification = Notification::find($notification_id);
        $users = User::all();
        $title = $notification->title;
        $body = $notification->body;
        // $type = $notification->type;

        foreach ($users as $user) {
            $user_app_token = $user->app_token;
            // send_notification_FCM($user_app_token, $title, $body);
        }

        return   redirect()->back()->with('Success', 'Notification sent successfully');
        // return response()->json(['result' => 'Notification sent successfully'], 200);
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
}
