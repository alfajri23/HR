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
            //mySch
            [
                'nama' => 'Aktivasi',
                'kode' => 'MY-1.1',
                'kode_obj' => 'MY-1',
            ],
            [
                'nama' => 'Perpanjangan',
                'kode' => 'MY-1.2',
                'kode_obj' => 'MY-1',
            ],
            [
                'nama' => 'Upgrade',
                'kode' => 'MY-1.3',
                'kode_obj' => 'MY-1',
            ],
            [
                'nama' => 'LMS',
                'kode' => 'MY-1.4',
                'kode_obj' => 'MY-1',
            ],
            [
                'nama' => 'White Label',
                'kode' => 'MY-1.5',
                'kode_obj' => 'MY-1',
            ],
            [
                'nama' => 'Produk Lain',
                'kode' => 'MY-1.6',
                'kode_obj' => 'MY-1',
            ],
            [
                'nama' => 'Mempertahankan Jumlah Pelanggan 90%',
                'kode' => 'MY-2.1',
                'kode_obj' => 'MY-2',
            ],
            [
                'nama' => 'Critical issue diselesaikan dalam waktu 1 jam',
                'kode' => 'MY-2.2',
                'kode_obj' => 'MY-2',
            ],
            [
                'nama' => 'Support Konten',
                'kode' => 'MY-2.7',
                'kode_obj' => 'MY-2',
            ],
            [
                'nama' => 'Proses aktivasi  tidak lebih dari 1 jam',
                'kode' => 'MY-2.3',
                'kode_obj' => 'MY-2',
            ],
            [
                'nama' => 'Penyelesaian komplain tidak lebih dari 24 jam',
                'kode' => 'MY-2.4',
                'kode_obj' => 'MY-2',
            ],
            [
                'nama' => 'Template website terbaru',
                'kode' => 'MY-2.5',
                'kode_obj' => 'MY-2',
            ],
            [
                'nama' => 'Bisa mendapatkan partner dari tiap wilayah',
                'kode' => 'MY-3.1',
                'kode_obj' => 'MY-3',
            ],
            [
                'nama' => 'Bisa mendapatkan 1 referral dari 10 klien',
                'kode' => 'MY-3.2',
                'kode_obj' => 'MY-3',
            ],
            //BM
            [
                'nama' => 'Meningkatnya Traffic Website',
                'kode' => 'MK-1.1',
                'kode_obj' => 'MK-1',
            ],
            [
                'nama' => 'Menaikkan User Conversion',
                'kode' => 'MK-1.10',
                'kode_obj' => 'MK-1',
            ],
            [
                'nama' => 'Meningkatnya Tayangan Harian: Tiktok',
                'kode' => 'MK-2.1',
                'kode_obj' => 'MK-2',
            ],
            [
                'nama' => 'Meningkatnya Jumlah Follower: Tiktok',
                'kode' => 'MK-2.4',
                'kode_obj' => 'MK-2',
            ],
            [
                'nama' => 'Performa Content Selling : Tiktok',
                'kode' => 'MK-2.7',
                'kode_obj' => 'MK-2',
            ],
            [
                'nama' => 'Meningkatnya Engagement  Rate: Tiktok',
                'kode' => 'MK-2.9',
                'kode_obj' => 'MK-2',
            ],
            //dev
            [
                'nama' => 'Penambahan Produk / Aplikasi',
                'kode' => 'DV-1.1',
                'kode_obj' => 'DV-1',
            ],
            [
                'nama' => 'Requirement',
                'kode' => 'DV-1.5',
                'kode_obj' => 'DV-1',
            ],
            [
                'nama' => 'Peningkatan Customer Experience / Penambahan Fitur Dr Client',
                'kode' => 'DV-2.1',
                'kode_obj' => 'DV-2',
            ],
            [
                'nama' => 'Peningkatan Kualitas Produk / Aplikasi',
                'kode' => 'DV-2.2',
                'kode_obj' => 'DV-2',
            ],
            [
                'nama' => 'Peningkatan Performa Aplikasi',
                'kode' => 'DV-2.3',
                'kode_obj' => 'DV-2',
            ],
            [
                'nama' => 'Penyelesaian Komplain / Jumlah Komplain',
                'kode' => 'DV-3.1',
                'kode_obj' => 'DV-3',
            ],
            [
                'nama' => 'Kecepatan Implementasi',
                'kode' => 'DV-3.4',
                'kode_obj' => 'DV-3',
            ],
            //mm
            [
                'nama' => 'Peningkatan Subscriber dari 2500 ke 20000',
                'kode' => 'MM-1.1',
                'kode_obj' => 'MM-1',
            ],
            [
                'nama' => 'Peningkatan Jam tayang dari 1500 jam ke 4000 jam',
                'kode' => 'MM-1.2',
                'kode_obj' => 'MM-1',
            ],
            [
                'nama' => 'Peningkatan View dari 100.000 view ke 1 Juta view',
                'kode' => 'MM-1.3',
                'kode_obj' => 'MM-1',
            ],
            [
                'nama' => 'Peningkatan user event dari 2500 ke 25000',
                'kode' => 'MM-2.1',
                'kode_obj' => 'MM-2',
            ],
            [
                'nama' => 'Penambahan user dari website',
                'kode' => 'MM-2.2',
                'kode_obj' => 'MM-2',
            ],
            [
                'nama' => 'Penjualan Kelas Konsultasi',
                'kode' => 'MM-3.1',
                'kode_obj' => 'MM-3',
            ],
            [
                'nama' => 'Penjualan Video On Demand',
                'kode' => 'MM-3.2',
                'kode_obj' => 'MM-3',
            ],
            [
                'nama' => 'Penjualan Fitur Premium',
                'kode' => 'MM-3.3',
                'kode_obj' => 'MM-3',
            ],
            [
                'nama' => 'Paket Bundling',
                'kode' => 'MM-3.4',
                'kode_obj' => 'MM-3',
            ],
            [
                'nama' => 'Webinar berbayar',
                'kode' => 'MM-3.5',
                'kode_obj' => 'MM-3',
            ],
            [
                'nama' => 'Kerjasama B2B/B2G',
                'kode' => 'MM-3.6',
                'kode_obj' => 'MM-3',
            ],
            [
                'nama' => 'Monetize Youtube',
                'kode' => 'MM-3.7',
                'kode_obj' => 'MM-3',
            ],
            [
                'nama' => 'Fundrising',
                'kode' => 'MM-3.8',
                'kode_obj' => 'MM-3',
            ],
            [
                'nama' => 'Penambahan Product Digital',
                'kode' => 'MM-4.1',
                'kode_obj' => 'MM-4',
            ],
            [
                'nama' => 'Penambahan Produk Fitur',
                'kode' => 'MM-4.2',
                'kode_obj' => 'MM-4',
            ],
            //hr
            [
                'nama' => 'Peningkatan rata-rata kedisiplinan karyawan dari (94,6%) menjadi 96%',
                'kode' => 'HR-1.1',
                'kode_obj' => 'HR-1',
            ],
            [
                'nama' => 'Level Kompetensi karyawan dari 79,6% menjadi (85%)',
                'kode' => 'HR-1.2',
                'kode_obj' => 'HR-1',
            ],
            [
                'nama' => 'Menjamin 100% persediaan Tallent sesuai kebutuhan perusahaan di setiap divisi dan kwartal',
                'kode' => 'HR-1.3',
                'kode_obj' => 'HR-1',
            ],
            [
                'nama' => 'Engagement & motivasi per team mencapai (83%) untuk mendukung target team tiap kwartal',
                'kode' => 'HR-2.2',
                'kode_obj' => 'HR-2',
            ],
            [
                'nama' => 'Rata-Rata Tingkat kepuasan karyawan Terhadap Perusahaan naik dari (4.10) menjadi (4.20) di kwartal 1 dan 3',
                'kode' => 'HR-2.3',
                'kode_obj' => 'HR-2',
            ],
            [
                'nama' => 'Tingkat keberhasilan OKR di Q1 (70%)',
                'kode' => 'HR-4.1',
                'kode_obj' => 'HR-4',
            ],
        ]);
    }
}
