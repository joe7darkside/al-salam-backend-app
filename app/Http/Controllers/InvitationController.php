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

    public function getinvitations()
    {

        $invitations = Invitation::orderBy('created_at', 'desc')->paginate(10);

        return response()->json(['invitations' => $invitations]);
        // return View::make('dashboard.invitations.overview', ['invitations' => $invitations]);
    }

    /**
     * Return overview view with array of search results invitations
    
     * @return View|array
     */

    public function search(Request $request)
    {

        $search_text = $request->input('search');


        if (isset($search_text)) {
            $invitations = Invitation::where('visiter_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('permission', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $invitations->appends($request->all());

            // return response()->json(['invitations' => $invitations]);
            return View::make('dashboard.invitations.overview',  ['invitations' => $invitations]);
        }
        $invitations = Invitation::orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['invitations' => $invitations]);
        return View::make('dashboard.invitations.overview',  ['invitations' => $invitations]);
    }


    /**
     * Return overview view with array of invitations
    
     * @return View|array
     */

    public function categorizedInvitations($category)
    {

        $invitations = Invitation::where('permission', 'LIKE', '%' . $category . '%')
            ->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['invitations' => $invitations]);
        return View::make('dashboard.invitations.categorized', ['invitations' => $invitations]);
    }



    /**
     * Return overview view with array of search results invitations
    
     * @return View|array
     */

    public function categorizedSearch(Request $request, $category)
    {
        $search_text = $request->input('search');

        if (isset($search_text)) {
            $invitations = invitation::where('permission', 'LIKE', '%' . $category . '%')
                ->Where('visiter_name', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $invitations->appends($request->all());

            // return response()->json(['invitations' => $invitations]);
            return View::make('dashboard.invitations.categorized',  ['invitations' => $invitations]);
        }
        $invitations = invitation::where('permission', 'LIKE', '%' . $category . '%')
            ->orderBy('created_at', 'desc')->paginate(10);

        // return response()->json(['invitations' => $invitations]);
        return View::make('dashboard.invitations.categorized',  ['invitations' => $invitations]);
    }
}
