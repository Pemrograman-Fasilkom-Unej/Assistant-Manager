<?php

use App\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetupConfig extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            'semester' => 1,
            'year' => 2020
        ];

        DB::transaction(function () use ($configs) {
            foreach ($configs as $key => $value) {
                Config::create([
                    'key' => $key,
                    'value' => $value
                ]);
            }
        });
    }
}
