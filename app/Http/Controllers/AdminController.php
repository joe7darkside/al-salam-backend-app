<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Builder;

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

        // $admins = Admin::whereDoesntHave(function (Builder $query) use ($request) {
        //     $query->where('email', 'LIKE', '%' . $request->user()->email . '%')
        //         ->orWhere('phone', 'LIKE', '%' . $request->user()->phone . '%');
        // })->get();
        return View::make('dashboard.admins.overview',  ['admins' => $admins, 'admin' => $admin]);

        // return response()->json(['admins' => $admins]);
    }


    /**
     * Update the specified admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateAdmin(Request $request, $id)
    {

        $admin = Admin::find($id);

        if ($admin) {
            $admin->update($request->all());
            return View::make('dashboard.admins.overview')
                ->with('Message', 'updated successfully.');
        } else {
            return View::make('dashboard.admins.overview')
                ->with('Message', 'No Data Updated');
        }
    }


    /**
     * Remove the specified admin from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $admin = $request->user()->first_name;
        $adminData = Admin::find($id);

        if ($adminData) {
            $adminData->delete();
            return redirect()->back()
                ->with(['Message' => 'Deleted Successfully.', 'admin' => $admin]);
        } else {
            return redirect()->back()
                ->with(['Message' => 'Record Faild to Deleted', 'admin' => $admin]);
            // return View::make('dashboard.admins.overview', ['admin' => $admin])
            //     ->with('Message', 'Record Faild to Deleted');
        }
    }


    /**
     * Return overview view with array search results of admins
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
                ->orWhere('rule', 'LIKE', '%' . $search_text . '%')
                ->orWhere('email', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'asc')
                ->paginate(10);

            $admins->appends($request->all());

            // return response()->json(['admins' => $admins]);
            return View::make('dashboard.admins.overview',  ['admins' => $admins, 'admin' => $admin]);
        }
        $admins =  Admin::orderBy('created_at', 'asc')->paginate(10);


        // return response()->json(['admins' => $admins]);
        return View::make('dashboard.admins.overview',  ['admins' => $admins, 'admin' => $admin]);
    }


    // /**
    //  * Return profile view with admin details
    //  * @param Request $request
    //  * @return View
    //  */

    // public function getAdminProfile($id)
    // {
    //     $admin = Admin::find($id);

    //     return View::make('dashboard.admins.profile',  ['admin' => $admin]);
    //     // return response()->json(['admin' => $admin]);
    // }

    /**
     * Return overview view with array of admins
    
     * @return View|array
     */

    public function categorizedAdmins($category)
    {

        $admins = Admin::where('rule', 'LIKE', '%' . $category . '%')
            ->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['invitations' => $invitations]);
        return View::make('dashboard.admins.categorized', ['admins' => $admins]);
    }



    /**
     * Return overview view with array of search results admins
    
     * @return View|array
     */

    public function categorizedSearch(Request $request, $category)
    {
        $search_text = $request->input('search');

        if (isset($search_text)) {
            $admins = Admin::where('rule', 'LIKE', '%' . $category . '%')
                ->where('first_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('phone', 'LIKE', '%' . $search_text . '%')
                ->orWhere('email', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $admins->appends($request->all());

            // return response()->json(['invitations' => $invitations]);
            return View::make('dashboard.admins.categorized',  ['admins' => $admins]);
        }
        $admins = Admin::where('permission', 'LIKE', '%' . $category . '%')
            ->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['invitations' => $invitations]);
        return View::make('dashboard.admins.categorized',  ['admins' => $admins]);
    }
}
