<?php

namespace App\Settings;

use Spatie\LaravelData\Data;

class InfobipSettings extends Data
{
    public function __construct(
        public string $base_url = 'https://api.infobip.com',
        public bool $enabled = false,
        public string $api_key_prefix = 'App',
        public string $api_key = '1234567890',
        public string $sender_id = 'InfoBip'
    ) {}
}
