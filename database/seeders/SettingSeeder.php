<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'name' => 'telegram_notification',
                'value' => 0
            ],
            [
                'name' => 'telegram_key',
                'value' => env('TELEGRAM_BOT_KEY', '-')
            ],
            [
                'name' => 'season',
                'value' => 1
            ],
            [
                'name' => 'year',
                'value' => now()->year
            ]
        ]);
    }
}
