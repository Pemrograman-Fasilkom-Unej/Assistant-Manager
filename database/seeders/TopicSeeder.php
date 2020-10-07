<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::insert([
            [
                'name' => 'Algoritma dan Pemrograman 1',
                'short_name' => 'Algo 1',
                'slug' => 'algo-1'
            ],
            [
                'name' => 'Algoritma dan Pemrograman 2',
                'short_name' => 'Algo 2',
                'slug' => 'algo-2'
            ],
            [
                'name' => 'Pemrograman Berorientasi Objek 1',
                'short_name' => 'PBO 1',
                'slug' => 'pbo-1'
            ],
            [
                'name' => 'Pemrograman Berorientasi Objek 2',
                'short_name' => 'PBO 2',
                'slug' => 'pbo-2'
            ],
            [
                'name' => 'Perancangan Website',
                'short_name' => 'PW',
                'slug' => 'pw'
            ],
            [
                'name' => 'Pemrograman Website',
                'short_name' => 'Pemweb',
                'slug' => 'pemweb'
            ],
            [
                'name' => 'Grafika Komputer',
                'short_name' => 'Grafkom',
                'slug' => 'grafkom'
            ],
            [
                'name' => 'Pemrograman Mobile',
                'short_name' => 'Mobile',
                'slug' => 'mobile'
            ],
        ]);
    }
}
