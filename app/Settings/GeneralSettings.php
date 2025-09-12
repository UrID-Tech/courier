<?php

namespace App\Settings;

use Spatie\LaravelData\Data;

class GeneralSettings extends Data
{
    public function __construct(
        public string $currency = 'RWF',
        public string $country = 'RW',
        public string $default_sms_gateway = 'Dummy',
        public string $sms_sender_id = 'COURIER',
        public bool $enable_sms_sending = true,
        public bool $enable_sms_logs = false,
        public bool $allow_guest_checkout = true,
    ) {}
}
