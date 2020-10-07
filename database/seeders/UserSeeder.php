<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $this->importStudentData();
    }

    private function importStudentData()
    {
        try {
            DB::beginTransaction();
            $files = Storage::disk('database')->allFiles();
            foreach ($files as $file) {
                $batch = Storage::disk('database')->get($file);
                $datas = Str::of($batch)->explode("\n");
                unset($datas[count($datas) - 1]);
                foreach ($datas as $data) {
                    $d = explode(",", $data);
                    $user = User::create([
                        'username' => $d[0],
                        'name' => $d[1]
                    ]);
                    $user->assignRole('student');
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
        }
    }
}
