<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InvitationController extends Controller
{
    public function addInvitation(Request $request)
    {
        $user_id = $request->user()->id;

        $Invitation = Invitation::create([
            'user_id' => $user_id,
            'visiter_name' => $request->visiter_name,
            'permission' => true,
        ]);

        return response()->json(['Invitation' => $Invitation]);

        // $date = Carbon::now();

        // $monthName = $date->format('F');

        // var_dump($monthName);
        // $myDate = '01/07/2020';
        // $date = Carbon::createFromFormat('m/d/Y', $myDate);

        // $monthName = $date->format('F');

        // var_dump($monthName);
    }


    public function getUserInvitaions(Request $request)
    {
        $user_id = $request->user()->id;
        $user_invitation = User::find($user_id)->invitaion;

        return response()->json(['User invitaion' => $user_invitation], 200);
    }
}
