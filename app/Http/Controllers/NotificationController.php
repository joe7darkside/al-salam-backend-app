<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NotificationUser;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::orderByRaw('updated_at - created_at DESC')->paginate(10);


        return view('notifications.index', [
            'notifications' => $notifications,

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

        Notification::create([
            'admin_id' => $admin_id,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type' => $request->type,

        ]);
        return redirect()->back()->with('create', 'Notification created successfully.');
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

        return view('notifications.edit', ['notification' => $notification]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->update($request->all());
            return redirect()->route('notifications.index')
                ->with('updated', 'Notification updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->delete();
            return redirect()->back()->with('deleted', 'Notification deleted successfully');
        } else
            return redirect()->back()->with('deleted', 'Record Faild to Deleted');
    }


    /**
     * push notification to mobile app.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send($id)
    {
        $notification = Notification::find($id);
        $users = User::all();
        $title = $notification->title;
        $body = $notification->body;
        $type = $notification->type;

        foreach ($users as $user) {
            $user_app_token = $user->app_token;
            send_notification_FCM($user_app_token, $title, $body);
        }

        redirect()->back()->with('sussess', 'Notification sent successfully');
        // return response()->json(['result' => 'Notification sent successfully'], 200);
    }


    public function search(Request $request)
    {
        $search_text = $request->input('search');

        if (isset($search_text)) {
            $notifications = Notification::where('title', 'LIKE', '%' . $search_text . '%')
                ->orWhere('body', 'LIKE', '%' . $search_text . '%')
                ->orWhere('type', 'LIKE', '%' . $search_text . '%')
                ->orderByRaw('updated_at - created_at DESC')
                ->paginate(10);
            $notifications->appends($request->all());

            return view(
                'notifications.index',
                ['notifications' => $notifications]
            );
        }
        $notifications = Notification::orderByRaw('updated_at - created_at DESC')->paginate(10);

        return view(
            'notifications.index',
            ['notifications' => $notifications]
        );
    }
}
