<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeyresultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keyresults')->insert([
            [
                'nama' => 'Menambah makanan',
                'kode' => 'MY-1.1',
                'kode_obj' => 'MY-1',
                'deskripsi' => 'deskripsi',
            ],
            [
                'nama' => 'Menambah minuman',
                'kode' => 'MY-1.2',
                'kode_obj' => 'MY-1',
                'deskripsi' => 'deskripsi',
            ],
        ]);
    }
}
