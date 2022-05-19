<?php



/**
 * Return JSON response 
 * @param string $app_token
 * @param string $title
 * @param string $body
 * @return Response|JSON
 */

function send_notification_FCM($app_token, $title, $body)
{

    $SERVER_API_KEY = env('FCM_KEY');


    $data = [

        "registration_ids" => [
            $app_token
        ],

        "notification" => [

            "title" => $title,

            "body" => $body,

            "sound" => "default" // required for sound on ios

        ],

    ];

    $dataString = json_encode($data);

    $headers = [

        'Authorization: key=' . $SERVER_API_KEY,

        'Content-Type: application/json',

    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    return $response;
}