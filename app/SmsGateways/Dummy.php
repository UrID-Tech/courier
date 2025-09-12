<?php

namespace App\SmsGateways;

use App\Interfaces\SendsTextMessages;
use Illuminate\Support\Str;

class Dummy implements SendsTextMessages
{
    public function send($receiver, $message, $sender = 8228)
    {
        return [
            'code' =>  200,
            'status' => 'success',
            'message' => 'success',
            'gateway_reference' => Str::uuid()
        ];
    }
}
