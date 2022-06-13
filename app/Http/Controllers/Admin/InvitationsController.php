<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Models\invitation;
use App\Models\User;

class InvitationsController extends Controller
{
    /**
     * Return overview view with array of invitations.
     *
     * @return View|array
     */

    public function getInvitations(Request $request)
    {
        $admin = $request->user()->first_name;

        $invitations = Invitation::orderBy('created_at', 'desc')
            ->with(['user'])->paginate(10);

        // return response()->json([
        //     'invitations' => $invitations,
        //     'admin' => $admin
        // ]);

        return View::make('dashboard.invitations.overview', [
            'invitations' => $invitations,
            'admin' => $admin
        ]);
    }


    /**
     * Return overview view with array of search results invitations
     *
     * @return View|array
     */

    public function search(Request $request)
    {

        $search_text = $request->input('search');
        $admin = $request->user()->first_name;

        if (isset($search_text)) {
            $invitations = Invitation::with('user')
                ->where('guest_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('permission', 'LIKE', '%' . $search_text . '%')
                ->orWhereHas('user', function ($q) use ($search_text) {
                    $q->where('first_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
                    // $q->orWhere('phone', 'LIKE', '%' . $search_text . '%');
                    // $q->orWhere('email', 'LIKE', '%' . $search_text . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $invitations->appends($request->all());

            return View::make('dashboard.invitations.overview',  ['invitations' => $invitations, 'admin' => $admin]);
        }
        $invitations = Invitation::orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.invitations.overview',  ['invitations' => $invitations, 'admin' => $admin]);
    }


    /**
     * Return overview view with array of invitations
    
     * @return View|array
     */


    public function categorizedInvitations($category, Request $request)
    {
        $admin = $request->user()->first_name;

        $invitations = Invitation::where('permission', 'LIKE', '%' . $category . '%')
            ->with('user')
            ->orderBy('created_at', 'desc')->paginate(10);

        if ($category == 1) {
            $category_name = 'Approved';
        } else if ($category == 0) {

            $category_name  = 'Pandding';
        } else {
            $category_name  = 'Denied';
        }
        return View::make('dashboard.invitations.categorized', [
            'invitations' => $invitations,
            'admin' => $admin,
            'category_name' => $category_name,
            'category' => $category,
        ]);
    }


    /**
     * Return overview view with array of search results invitations
    
     * @return View|array
     */

    public function categorizedSearch(Request $request, $category)
    {
        $search_text = $request->input('search');
        $admin = $request->user()->first_name;
        if ($category == 1) {
            $category_name = 'Approved';
        } else if ($category == 0) {

            $category_name  = 'Pandding';
        } else {
            $category_name  = 'Denied';
        }
        if (isset($search_text)) {
            $invitations = invitation::with('user')->where('permission', 'LIKE', '%' . $category . '%')
                ->where('guest_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('permission', 'LIKE', '%' . $category . '%')
                ->whereHas('user', function ($q) use ($search_text) {

                    $q->where('first_name', 'LIKE', '%' . $search_text . '%');
                    $q->orWhere('last_name', 'LIKE', '%' . $search_text . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $invitations->appends($request->all());

            return View::make('dashboard.invitations.categorized',  [
                'invitations' => $invitations,
                'admin' => $admin,
                'category' => $category,
                'category_name' => $category_name
            ]);
        }
        $invitations = invitation::where('permission', 'LIKE', '%' . $category . '%')
            ->with('user')
            ->orderBy('created_at', 'desc')->paginate(10);

        return View::make('dashboard.invitations.categorized',  [
            'invitations' => $invitations,
            'admin' => $admin,
            'category' => $category,
            'category_name' => $category_name
        ]);
    }


    /**
     * Return specified invitation with details
     * @param Int $id
     * @return Response|Json
     */

    public function edit($id)
    {

        $invitation = Invitation::find($id);
        $invitation->user;

        return response()->json($invitation);
    }


    public function update(Request $request)
    {
        $invitation_id = $request->input('invitation_id');
        $action = $request->input('permission');
        $invitation = Invitation::find($invitation_id);

        switch ($action) {
            case '1':
                $invitation->update(['permission' => $action]);
                return redirect()->back()->with('Success', 'The Invitation is Approved');
                break;

            case '2':
                $invitation->update(['permission' => $action]);
                return redirect()->back()->with('Error', 'The Invitation is Denied');
                break;

            default:
                # code...
                break;
        }
    }
}
