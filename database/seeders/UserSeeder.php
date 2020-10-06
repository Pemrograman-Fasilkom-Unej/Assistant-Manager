<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $user = User::create([
            'name' => 'Pemrograman',
            'username' => 'ngadimin',
            'email' => 'pemroofficial@cs.unej.ac.id',
            'password' => Hash::make('a')
        ]);

        $user->assignRole('admin');
    }
}
