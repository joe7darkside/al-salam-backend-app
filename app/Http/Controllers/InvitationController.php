<?php

namespace App\Http\Controllers;

use App\Models\invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;

class invitationController extends Controller
{
    public function addinvitation(Request $request)
    {
        $user_id = $request->user()->id;

        $invitation = Invitation::create([
            'user_id' => $user_id,
            'visiter_name' => $request->visiter_name,
            'permission' => true,
        ]);

        return response()->json(['invitation' => $invitation]);
    }


    public function getUserInvitaions(Request $request)
    {
        $user_id = $request->user()->id;
        $user_invitation = User::find($user_id)->invitaion;

        return response()->json(['User invitaion' => $user_invitation], 200);
    }






    /**
     * Return overview view with array of invitations
    
     * @return View|array
     */

    public function getInvitations(Request $request)
    {
        $admin = $request->user()->first_name;

        $invitations = Invitation::orderBy('created_at', 'desc')->with('user')->paginate(10);

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
    
     * @return View|array
     */

    public function search(Request $request)
    {

        $search_text = $request->input('search');
        $admin = $request->user()->first_name;

        if (isset($search_text)) {
            $invitations = Invitation::where('visiter_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('permission', 'LIKE', '%' . $search_text . '%')
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $invitations->appends($request->all());

            // return response()->json(['invitations' => $invitations]);
            return View::make('dashboard.invitations.overview',  ['invitations' => $invitations, 'admin' => $admin]);
        }
        $invitations = Invitation::orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['invitations' => $invitations]);
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

        if ($category) {
            $category_name = 'Approved';
        } else {

            $category_name  = 'Denied';
        }
        // return response()->json(['invitations' => $invitations]);
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
        if ($category) {
            $category_name = 'Approved';
        } else {

            $category_name  = 'Denied';
        }
        if (isset($search_text)) {
            $invitations = invitation::where('permission', 'LIKE', '%' . $category . '%')
                ->Where('visiter_name', 'LIKE', '%' . $search_text . '%')
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $invitations->appends($request->all());

            // return response()->json(['invitations' => $invitations]);
            return View::make('dashboard.invitations.categorized',  ['invitations' => $invitations, 'admin' => $admin, 'category' => $category, 'category_name' => $category_name]);
        }
        $invitations = invitation::where('permission', 'LIKE', '%' . $category . '%')
            ->with('user')
            ->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['invitations' => $invitations]);
        return View::make('dashboard.invitations.categorized',  ['invitations' => $invitations, 'admin' => $admin, 'category' => $category, 'category_name' => $category_name]);
    }
}
