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
                'logo' => 'asset/img/divisi/budimark.png',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'Budimark',
                'id_manager' => 2,
                'logo' => 'asset/img/divisi/budimark.png',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'MySch',
                'id_manager' => 3,
                'logo' => 'asset/img/divisi/mysch.png',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'Makin mahir',
                'id_manager' => 4,
                'logo' => 'asset/img/divisi/1642048087_makinmahir.jpg',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'Developers',
                'id_manager' => 5,
                'logo' => 'asset/img/divisi/dev.png',
                'deskripsi' => 'deskripsi',
            ],
            
        ]);
    }
}
