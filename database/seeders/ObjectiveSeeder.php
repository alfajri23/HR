<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('objectives')->insert([
            [
                'nama' => 'Meningkatkan karyawan',
                'kode' => 'MY-1',
                'id_divisi' => 1,
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'Meningkatkan kerja',
                'kode' => 'MY-2',
                'id_divisi' => 1,
                'deskripsi' => 'deskripsi',
            ],
        ]);
    }
}
