<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use App\Settings\AfricasTalkingSettings;
use App\Settings\InfobipSettings;
use App\Services\SettingsManager;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Concerns\InteractsWithForms;
use UnitEnum;
use BackedEnum;
use Filament\Actions\Action;

class CompanySettings extends Page implements HasForms
{
    use InteractsWithForms;


    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static UnitEnum|string|null $navigationGroup = 'Settings';
    protected static ?string $title = 'Company Settings';

    protected string $view = 'filament.pages.company-settings';

    public ?array $data = [];

    public function mount(SettingsManager $settings): void
    {

        $general = $settings->get(GeneralSettings::class);
        $africasTalking = $settings->get(AfricasTalkingSettings::class);
        $infoBip = $settings->get(InfobipSettings::class);

        $this->form->fill([
            'general' => $general->toArray(),
            'africastalking' => $africasTalking->toArray(),
            'infobip' => $infoBip->toArray(),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tenant Settings')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                Forms\Components\Select::make('general.currency')
                                    ->options([
                                        'RWF' => 'Rwandan Franc',
                                        'GBP' => 'British Pound',
                                        'KES' => 'Kenyan Shilling',
                                        'NGN' => 'Nigerian Naira',
                                        'UGX' => 'Ugandan Shilling',
                                        'TZS' => 'Tanzanian Shilling',
                                        'ZAR' => 'South African Rand',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('general.country')
                                    ->options([
                                        'RW' => 'Rwanda',
                                        'GB' => 'United Kingdom',
                                        'KE' => 'Kenya',
                                        'NG' => 'Nigeria',
                                        'UG' => 'Uganda',
                                        'TZ' => 'Tanzania',
                                        'ZA' => 'South Africa',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('general.default_sms_gateway')
                                    ->options([
                                        'Dummy' => 'Dummy',
                                        'AfricasTalking' => 'Africas Talking',
                                        'Infobip' => 'Infobip',
                                    ])
                                    ->required(),
                                Forms\Components\Toggle::make('general.enable_sms_sending')
                                    ->label('Enable SMS Sending'),
                                Forms\Components\Toggle::make('general.enable_sms_logs')
                                    ->label('Enable SMS Logs'),
                                Forms\Components\Toggle::make('general.allow_guest_checkout')
                                    ->label('Allow Guest Checkout'),
                            ]),

                        Tab::make('Africa\'s Talking')
                            ->schema([
                                Forms\Components\TextInput::make('africastalking.api_key')
                                    ->password()
                                    ->required(),
                                Forms\Components\TextInput::make('africastalking.username')
                                    ->required(),
                                Forms\Components\TextInput::make('africastalking.application_name'),
                                Forms\Components\Toggle::make('africastalking.enabled')
                                    ->label('Enabled'),
                            ]),

                        Tab::make('InfoBip')
                            ->schema([
                                Forms\Components\TextInput::make('infobip.api_key')
                                    ->password()
                                    ->required(),
                                Forms\Components\TextInput::make('infobip.api_key_prefix')
                                    ->required(),
                                Forms\Components\TextInput::make('infobip.base_url')
                                    ->required(),
                                Forms\Components\TextInput::make('infobip.sender_id'),
                                Forms\Components\Toggle::make('infobip.enabled')
                            ]),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(SettingsManager $settings): void
    {


        $settings->set(GeneralSettings::from($this->data['general']));
        $settings->set(AfricasTalkingSettings::from($this->data['africastalking']));
        $settings->set(InfobipSettings::from($this->data['infobip']));

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Settings')
                ->submit('save'),
        ];
    }
}
