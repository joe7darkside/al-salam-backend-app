<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Return overview view with array of admins
     * @param Request $request
     * @return View|array
     */

    public function getAdmins(Request $request)
    {

        $admin = $request->user()->first_name;

        $admins = Admin::orderBy('created_at', 'asc')->paginate(10);

        return View::make('dashboard.admins.overview',  ['admins' => $admins, 'admin' => $admin]);
    }

    /**
     * Add new Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|digits:11|max:11|unique:admins',
            'email' => 'required|string|email|max:255|unique:admins',
            'role' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            redirect()->back()->with(['Error', $validator->errors()->toJson()]);            // return response()->json($validator->errors()->toJson(), 400);
        }
        Admin::create(
            array_merge(
                $validator->validated(),
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'role' => $request->role,
                    'password' => Hash::make($request->password),
                ]
            )

        );


        return redirect()->back()->with('Success', 'Created Successfully.');
    }



    /**
     * Delete the specified admin from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $admin_id = $request->user()->id;

        $id = $request->input('delete_admin_id');

        $adminData = Admin::find($id);

        if ($admin_id != $id || $admin_id == 0) {


            if ($adminData) {

                $adminData->delete();

                return redirect()->back()->with('Error', 'Admin Deleted Successfully.');
            } else {

                return redirect()->back()->with('Error', 'No data deleted.');
            }
        }

        return redirect()->back()->with('Error', "Can't delete this account");
    }

    /**
     * Return overview view with search results of admins
     * @param Request $request
     * @return View|array
     */

    public function search(Request $request)
    {
        $admin = $request->user()->first_name;

        $search_text = $request->input('search');


        if (isset($search_text)) {
            $admins = Admin::where('first_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('phone', 'LIKE', '%' . $search_text . '%')
                ->orWhere('role', 'LIKE', '%' . $search_text . '%')
                ->orWhere('email', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'asc')
                ->paginate(10);

            $admins->appends($request->all());

            return View::make('dashboard.admins.overview',  ['admins' => $admins, 'admin' => $admin]);
        }
        $admins =  Admin::orderBy('created_at', 'asc')->paginate(10);


        return View::make('dashboard.admins.overview',  ['admins' => $admins, 'admin' => $admin]);
    }


    /**
     * Get the specified admin form DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);



        return response()->json(['status' => 200, 'admin' => $admin]);
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
        $id = $request->input('admin_id');
        $admin = Admin::find($id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'phone' => 'digits:11|max:11',
            'email' => 'string|email|max:255',
            'role' => 'string|max:255',
        ]);

        if ($admin) {

            if ($validator->fails()) {
                redirect()->back()->with(['Error', $validator->errors()->toJson()]);            // return response()->json($validator->errors()->toJson(), 400);
            }
            $admin->update(
                array_merge(
                    $validator->validated(),
                    [
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'role' => $request->role,
                        'password' => Hash::make($request->password),
                    ]
                )

            );
            return redirect()->back()->with('Warning', 'Update Successfully.');
        } else {

            return redirect()->back()->with('Error', 'No data Updated.');
        }
    }


    /**
     * Send message to the specified admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function send(Request $request)
    {
        $id = $request->input('send_admin_id');
        $admin = Admin::find($id);

        if ($admin) {
            return redirect()->back()->with('Send', 'Message sent Successfully.');
        } else {

            return redirect()->back()->with('Error', 'No data sent.');
        }
    }
}
