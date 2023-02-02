<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role' => 'admin',
                'title' => 'Admin'
            ],
            [
                'role' => 'assistant',
                'title' => 'Assistant'
            ],
        ];

        \App\Role::insert($roles);
    }
}
