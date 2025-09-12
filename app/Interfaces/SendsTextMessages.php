<?php

namespace App\Interfaces;

interface SendsTextMessages
{
    public function send(string $to, string $message, ?string $from = null, ?object $model = null);
}
