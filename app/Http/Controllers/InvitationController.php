<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    public function addInvitation(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'user_first_name' => 'required|string|max:255',
            'user_last_name' => 'required|string|max:255',
            'guest_name' => 'required|string|max:255',
            'phone' => 'required|digits:11|max:11',
            'email' => 'required|email|max:255',
            'visit_date' => 'required',
        ]);

        if ($validator->fails()) {
            redirect()->back()->with(['message', $validator->errors()->toJson()]);
            // return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::where('first_name', 'LIKE', '%' . $request->user_first_name . '%')
            ->where('last_name', 'LIKE', '%' . $request->user_last_name . '%')->first();

        if (!$user) {

            return redirect()->back()->with('Error', 'User not found');
            // return response()->json('User not found');
        }

        $guest = Guest::where('full_name', 'LIKE', '%' . $request->guest_name . '%')->first();

        if (!$guest) {
            $guest = Guest::create(
                array_merge(
                    $validator->validated(),
                    [
                        'user_id' => $user->id,
                        'full_name' => $request->guest_name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'last_visit' => '',
                        'visits' => 0,
                    ]
                )
            );
        }
        Invitation::create([
            'user_id' => $user->id,
            'guest_id' => $guest->id,
            'permission' => 0,


        ]);
        $last_invitation =  Invitation::where('guest_id', 'LIKE', '%' . $guest->id . '%')
            ->where('permission', 'LIKE', '%' . 1 . '%')
            ->latest('created_at')
            ->first();

        if ($last_invitation) {
            $guest_update = Guest::find($guest->id);
            $guest_update->update(['last_visit' => $last_invitation->created_at]);
        }
        return redirect()->back()->with('Success', 'Invitation add successfuly');
    }


    public function getUserInvitaions(Request $request)
    {

        $user_id = $request->user()->id;

        $user_invitation = Invitation::where('user_id', 'LIKE', $user_id)
            ->where('permission', 'LIKE', 0)
            ->get();

        foreach ($user_invitation as $invitation) {
            $guests[] =  $invitation->guest;
        }
        return response()->json($user_invitation);
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




    public function invitaionUpdate($id, Request $request)
    {
        $invitation = Invitation::find($id);

        if ($invitation) {

            $invitation->update($request->all());

            return response()->json('Submitted');
        }
        return response()->json('Nothing happend');
    }
}
