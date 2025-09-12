<?php

namespace App\SmsGateways;

use AfricasTalking\SDK\AfricasTalking as AfricasTalkingSDK;
use App\Interfaces\SendsTextMessages;
use App\Settings\AfricasTalkingSettings;

class AfricasTalking implements SendsTextMessages
{

    public function send($receiver, $message_body, $sender = 8228)
    {


        $username = app(AfricasTalkingSettings::class)->username;
        $apiKey   = app(AfricasTalkingSettings::class)->api_key;
        $AT       = new AfricasTalkingSDK($username, $apiKey);

        $sms      = $AT->sms();
        $result   = $sms->send([
            'to'      => $receiver,
            'message' => $message_body,
            //'from' => $sender
        ]);

        try {
            $data = $result['data']->SMSMessageData ?? [];
            $status = $data->Recipients[0]->status ?? 'failed';
            $message = $data->Message ?? 'api error';
            $reference = $data->Recipients[0]->messageId ?? null;

            return [
                'code' => $result['code'] ?? 200,
                'status' => $status,
                'message' => $message,
                'gateway_reference' => $reference
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
