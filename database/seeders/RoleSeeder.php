<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
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
        // Seeding permissions
        Permission::insert([
            [
                'name' => Permission::ASSIGN_ASSISTANT
            ],
            [
                'name' => Permission::CREATE_CLASS
            ],
            [
                'name' => Permission::ADD_STUDENT_CLASS
            ],
            [
                'name' => Permission::GRADING_CLASS
            ],
            [
                'name' => Permission::CONFIRM_CLASS
            ],
            [
                'name' => Permission::CREATE_ASSIGNMENT
            ],
            [
                'name' => Permission::EDIT_ASSIGNMENT
            ],
            [
                'name' => Permission::DELETE_ASSIGNMENT
            ],
            [
                'name' => Permission::SUBMIT_ASSIGNMENT
            ],
            [
                'name' => Permission::BROADCAST_TELEGRAM
            ],
        ]);

        // Seeding role
        $admin = Role::create([
            'name' => Role::ADMIN,
            'guard_name' => Role::ADMIN
        ]);

        $admin->givePermissionTo([
            Permission::ASSIGN_ASSISTANT,
            Permission::CREATE_CLASS,
            Permission::ADD_STUDENT_CLASS,
            Permission::CONFIRM_CLASS,
            Permission::CREATE_ASSIGNMENT,
            Permission::EDIT_ASSIGNMENT,
            Permission::DELETE_ASSIGNMENT,
            Permission::BROADCAST_TELEGRAM,
        ]);

        $assistant = Role::create([
            'name' => Role::ASSISTANT,
            'guard_name' => Role::ASSISTANT
        ]);

        $assistant->givePermissionTo([
            Permission::CREATE_CLASS,
            Permission::ADD_STUDENT_CLASS,
            Permission::GRADING_CLASS,
            Permission::CREATE_ASSIGNMENT,
            Permission::EDIT_ASSIGNMENT,
            Permission::DELETE_ASSIGNMENT,
        ]);

        $student = Role::create([
            'name' => Role::STUDENT,
            'guard_name' => Role::STUDENT
        ]);

        $assistant->givePermissionTo([
            Permission::SUBMIT_ASSIGNMENT,
        ]);
    }
}
