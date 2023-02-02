<?php

use App\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //



        $data = [
            [
                'nim' => "202410102003",
                'name' => "student1",
                'email' => "student1@gmail.com",
            ],
            [
                'nim' => "202410102004",
                'name' => "student2",
                'email' => "student2@gmail.com",
            ],

        ];
        DB::transaction(function () use ($data) {
            for ($i = 0; $i < count($data); $i++) {
                Student::create($data[$i]);
            }
        });
    }
}
