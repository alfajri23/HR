<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeyResultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('key_result_users')->insert([
            [
                'username' => 'Admin1',
                'kode_key' => 'MY-1.1',
                'target_1' => "0,0,0,0,0,0,0,0,0,0,0",
                'bobot' => 100,
            ]
        ]);
    }
}
