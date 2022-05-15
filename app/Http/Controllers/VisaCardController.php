<?php

namespace App\Http\Controllers;

use App\Models\VisaCard;
use Illuminate\Http\Request;

class VisaCardController extends Controller
{
    public function addVisaCard(Request $request)
    {
        $user_id = $request->user()->id;

        $card =  VisaCard::create([
            'user_id' => $user_id,
            'card_number' => $request->card_number,
            'expire' => $request->expire,
            'ccv_cvc' => $request->ccv_cvc,
            'card_owner' => $request->card_owner,

        ]);

        return  response()->json(['new card' => $card]);
    }
}
