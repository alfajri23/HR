<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisis')->insert([
            [
                'nama' => 'HR',
                'id_manager' => 1,
                'logo' => 'logo.png',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'Budimark',
                'id_manager' => 2,
                'logo' => 'logo.png',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'MySch',
                'id_manager' => 3,
                'logo' => 'logo.png',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'Makin mahir',
                'id_manager' => 4,
                'logo' => 'logo.png',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'Tim dev',
                'id_manager' => 5,
                'logo' => 'logo.png',
                'deskripsi' => 'deskripsi',
            ]
            
        ]);
    }
}
