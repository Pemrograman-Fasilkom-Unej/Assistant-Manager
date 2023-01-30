<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => "admin",
                'username' => "admin",
                'role_id' => 1,
                'nim' => "2024101030xx",
                'email' => "admin@gmail.com",
                'password' => Hash::make("123"),
            ],
            [
                'name' => "assistant",
                'username' => "assistant",
                'role_id' => 2,
                'nim' => "2024101030xx",
                'email' => "assistant@gmail.com",
                'password' => Hash::make("123"),
            ],
        ];
        DB::transaction(function () use ($data) {
            for ($i=0; $i < count($data); $i++) { 
                User::create($data[$i]);
            }
        });
    }
}