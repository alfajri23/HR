<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubdivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subdivisis')->insert([
            ['nama' => 'Lanjut kuliah'],
            ['nama' => 'Mysch'],
            ['nama' => 'Makin mhair']
        ]);
    }
}
