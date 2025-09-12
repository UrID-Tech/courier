<?php

namespace App\Helpers;

use App\Models\SmsLog;
use App\Services\IncomingSmsService;
use App\Services\SettingsManager;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Propaganistas\LaravelPhone\PhoneNumber;

class Sms
{
    public static function send(string $to, string $message, string $from = "COURIER", bool $debug = false, ?object $model = null)
    {
        $settings = app(SettingsManager::class);

        /** @var GeneralSettings $general */
        $general = $settings->get(GeneralSettings::class, $model);
        if (!$general->enable_sms_sending) {
            return ($debug) ? "Failed: Sms sending disabled" : false;
        }

        $defaultSmsGateway = $general->default_sms_gateway;
        $smsGateway = 'App\SmsGateways\\' . $defaultSmsGateway;
        if (!class_exists($smsGateway)) {
            return ($debug) ? "Failed: $defaultSmsGateway not Well configured" : false;
        }

        $countryOfOperation = $general->country;
        $phoneNumberObject = new PhoneNumber($to, $countryOfOperation);
        $phoneNumber = $phoneNumberObject->formatE164();

        try {
            $gateway = new $smsGateway;
            $result = $gateway->send($phoneNumber, $message, $from);

            $logMessage = "sms_log:- to: $phoneNumber, from: $from, status: {$result['status']}, message: $message";
            if ($general->enable_sms_logs) {
                Log::info($logMessage);
                $dbLog = new SmsLog;
                $dbLog->recipient = $phoneNumber;
                $dbLog->tenant_id = $model->tenant_id;
                $dbLog->status = $result['status'];
                $dbLog->message = $message;
                $dbLog->reference = $result['gateway_reference'];
                $dbLog->gateway_result = $result['status'];
                $dbLog->gateway = $defaultSmsGateway;
                $dbLog->save();
            }

            return ($debug) ? "Result: {$result['message']}" : true;
        } catch (\Exception $e) {
            Log::info("sms_log:- gateway_error: {$e->getMessage()}");
            return ($debug) ? "Failed: gateway error {$e->getMessage()}" : false;
        }
    }

    public static function gateways(): array
    {
        $path = base_path("app/SmsGateways");

        $gateways = collect(File::files($path))->map(function ($file, $key) {
            return explode('.' . $file->getExtension(), $file->getFilename())[0];
        })->toArray();

        return array_combine($gateways, $gateways);
    }
}
