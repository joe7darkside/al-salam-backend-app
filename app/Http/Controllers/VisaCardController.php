<?php

namespace App\Http\Controllers;

use App\Models\VisaCard;
use Illuminate\Http\Request;

class VisaCardController extends Controller
{
    // public function addVisaCard(Request $request)
    // {
    //     $user_id = $request->user()->id;

    //     VisaCard::create([
    //         'user_id' => $user_id,
    //         'card_number' => $request->card_number,
    //         'expire' => $request->expire,
    //         'ccv_cvc' => $request->ccv_cvc,
    //         'card_owner' => $request->card_owner,

    //     ]);

    //     return  response()->json(['VisaCard add successfuly', 'statusCode' => 200]);
    // }


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function deleteCard($id)
    // {
    //     $visaCard = VisaCard::find($id);

    //     if ($visaCard) {
    //         $visaCard->delete();
    //         return response()->json(['VisaCard deleted successfuly', 'statusCode' => 200]);
    //     } else {

    //         return response()->json('Something went wrong');
    //     }
    // }
}
