<?php

namespace App\Settings;

use Spatie\LaravelData\Data;

class AfricasTalkingSettings extends Data
{
    public function __construct(
        public bool $enabled = false,
        public string $api_key = '123',
        public string $username = 'sandbox',
        public ?string $application_name = 'sms',
    ) {}
}
