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
            //mySch
            [
                'nama' => 'Tercapainya Target Omset',
                'kode' => 'MY-1',
                'id_divisi' => 3,
            ],
            [
                'nama' => 'Memuaskan Pelanggan Dengan Support Luar Biasa',
                'kode' => 'MY-2',
                'id_divisi' => 3,
            ],
            [
                'nama' => 'MySCH.id memiliki perwakilan diwilayah Indonesia',
                'kode' => 'MY-3',
                'id_divisi' => 3,
            ],
            //Budimark
            [
                'nama' => 'Peningkatan Marketing Qualified Leads (MQL) website',
                'kode' => 'MK-1',
                'id_divisi' => 2,
            ],
            [
                'nama' => 'Meningkatkan Brand Awareness Social Media',
                'kode' => 'MK-2',
                'id_divisi' => 2,
            ],
            //DEV
            [
                'nama' => 'Pembuatan Aplikasi Smart School MySCH',
                'kode' => 'DV-1',
                'id_divisi' => 5,
            ],
            [
                'nama' => 'Penyempuranan Aplikasi Smart School MySCH',
                'kode' => 'DV-2',
                'id_divisi' => 5,
            ],
            [
                'nama' => 'Implementasi dan Maintenance Client / User',
                'kode' => 'DV-3',
                'id_divisi' => 5,
            ],
            //Mm
            [
                'nama' => 'Meningkatnya Branding Makin Mahir di Youtube',
                'kode' => 'MM-1',
                'id_divisi' => 4,
            ],
            [
                'nama' => 'Bertumbuhnya User Makin Mahir',
                'kode' => 'MM-2',
                'id_divisi' => 4,
            ],
            [
                'nama' => 'Bertumbuhnya User Makin Mahir',
                'kode' => 'MM-3',
                'id_divisi' => 4,
            ],
            [
                'nama' => 'Penambahan Produk Baru',
                'kode' => 'MM-4',
                'id_divisi' => 4,
            ],
            //hr
            [
                'nama' => 'Terciptanya Team yang kuat dan ideal untuk mencapai target perusahaan',
                'kode' => 'HR-1',
                'id_divisi' => 1,
            ],
            [
                'nama' => 'Terciptanya Lingkungan kerja berdasarkan budaya market.',
                'kode' => 'HR-2',
                'id_divisi' => 1,
            ],
            [
                'nama' => 'Adopsi OKR berjalan efektif',
                'kode' => 'HR-4',
                'id_divisi' => 1,
            ],
        ]);
    }
}
