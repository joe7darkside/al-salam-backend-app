<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VisaCard;
use Illuminate\Http\Request;

class VisaCardController extends Controller
{

    /**
     * Add new user VisaCard.
     * @param Int $id
     * @return Response|Json
     */
    public function add(Request $request)
    {
        $user_id = $request->user()->id;

        VisaCard::create([
            'user_id' => $user_id,
            'card_number' => $request->card_number,
            'expire' => $request->expire,
            'ccv_cvc' => $request->ccv_cvc,
            'card_owner' => $request->card_owner,

        ]);

        return  response()->json(200, 200);
    }

    /**
     * Remove the specified visaCard from DB.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $visaCard = VisaCard::find($id);

        if ($visaCard) {
            $visaCard->delete();
            return response()->json(['VisaCard deleted successfuly', 'statusCode' => 200]);
        } else {

            return response()->json('Something went wrong', 401);
        }
    }


    /**
     * Return a json response of the user visaCards
     * @param Request $request
     * @return array
     */
    public function get(Request $request)
    {
        $user_id = $request->user()->id;
        $user_cards = User::find($user_id)->VisaCard;

        return response()->json($user_cards);
    }
}
