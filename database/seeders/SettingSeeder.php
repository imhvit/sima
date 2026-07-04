<?php

namespace Database\Seeders;

use App\Enums\SettingsKey;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            SettingsKey::STOCK_MINIMUM->value => 10,
            SettingsKey::COMPANY_NAME->value => 'SIMA',
            SettingsKey::CURRENCY->value => 'PEN',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
