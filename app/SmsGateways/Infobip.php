<?php

namespace App\SmsGateways;

use App\Interfaces\SendsTextMessages;
use App\Settings\InfobipSettings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class Infobip implements SendsTextMessages
{


    public function send($receiver, $message_body, $sender = 8228)
    {

        $base_url = app(InfobipSettings::class)->base_url;
        $api_prefix = app(InfobipSettings::class)->api_key_prefix;
        $api_key = app(InfobipSettings::class)->api_key;
        $sender_id = app(InfobipSettings::class)->sender_id;


        $code = 400;
        $message = 'Sending failed';
        $gateway_reference = '1';
        $status = "FAILED";

        $response = Http::withHeaders([
            'Authorization' => "$api_prefix $api_key",
            'Accept' => 'application/json'
        ])->post("https://$base_url/sms/2/text/advanced", [
            'messages' => [
                'destinations' => [
                    'to' => $receiver
                ],
                'from' => $sender_id,
                'text' => $message_body
            ]
        ]);
        if ($response->failed()) {
            $code = 400;
            $message = 'Sending failed';
            $gateway_reference = '1';
            //$message = $response->json();
        } else if ($response->successful()) {
            $code = 200;
            $result = $response->json();
            $status = $result['messages'][0]['status']['name'];
            $gateway_reference = $result['messages'][0]['messageId'];
            $message = $result['messages'][0]['status']['description'];
        }

        return [
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'gateway_reference' => $gateway_reference
        ];
    }
}
