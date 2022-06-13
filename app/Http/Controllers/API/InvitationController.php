<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{

    /**
     * Add new user invitaction to DB.
     * @param  Request $request
     * @return View|array
     */

    public function addInvitation(Request $request)
    {

        $user_id = $request->user()->id;

        $data = $request->all();

        $validator = Validator::make($data, [
            'guest_name' => 'required|string|max:255',
            'visit_date' => 'required',
        ]);
        if ($validator->fails()) {
            redirect()->back()->with(['message', $validator->errors()->toJson()]);
            // return response()->json($validator->errors()->toJson(), 400);
        }

        $invitation = Invitation::create(
            array_merge($validator->validate(), [
                'user_id' => $user_id,
                'guest_name' => $request->guest_name,
                'visit_date' => $request->visit_date,
            ])
        );

        if ($invitation) {
            return response()->json(['Results' => 'Invitation add successfuly'], 200);
        }
        return response()->json(['Results' => 'Something went wrong'], 401);
    }

    /**
     * Get  user invitactions from DB.
     * @param  Request $request
     * @return Response|JSON
     */

    public function getUserInvitaions(Request $request)
    {

        $user_id = $request->user()->id;

        $user_invitation = Invitation::where('user_id', 'LIKE', $user_id)->get();

        if ($user_invitation) {
            
            return response()->json($user_invitation, 200);
        }
        return response()->json(['Results' => 'Something went wrong']);
    }
}
