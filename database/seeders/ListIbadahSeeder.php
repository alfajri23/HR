<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListIbadahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('list_ibadahs')->insert([
            [
                'nama' => 'Sholat 5 waktu tidak pernah bolong',
            ],
            [
                'nama' => 'Baca Al-Quran 1 juz per pekan',
            ],
            [
                'nama' => 'Sholat tahajud minimal 1x',
            ],
            [
                'nama' => 'Sholat dhuha minimal 1x',
            ],
            [
                'nama' => 'Sedekah minimal 1x',
            ],
            [
                'nama' => 'Baca buku/video seputar bidang ilmu yang ditekuni',
            ],
            [
                'nama' => 'Olahraga minimal 5 menit per hari',
            ],
            [
                'nama' => 'Puasa sunnah',
            ],
        ]);
    }
}
