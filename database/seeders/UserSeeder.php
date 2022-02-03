<?php

namespace Database\Seeders;
use App\Models\User;


use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'nama' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@hr.id',
            'password' => bcrypt('adminhr'),
            'jenkel' => 'l',
            'id_divisi' => 1,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);

        $admin->assignRole('admin');

        //MySch
        $user = User::create([
            'nama' => 'Nailil Fitri',
            'username' => 'Naili',
            'email' => 'naililfitri05@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'p',
            'id_divisi' => 3,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $user->assignRole('user_manager');

        $sch1 = User::create([
            'nama' => 'Riska',
            'username' => 'Riska',
            'email' => 'riskaharyanto01@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'p',
            'id_divisi' => 3,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $sch1->assignRole('user');

        $sch2 = User::create([
            'nama' => 'Denok Vina Wardani',
            'username' => 'Vina',
            'email' => 'devin.wardani387@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'p',
            'id_divisi' => 3,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $sch2->assignRole('user');

        $sch3 = User::create([
            'nama' => 'Anggi Oktavia Aryani',
            'username' => 'Anggi',
            'email' => 'anggi@gmail.id',
            'password' => bcrypt('12345678'),
            'jenkel' => 'p',
            'id_divisi' => 3,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $sch3->assignRole('user');

        //Makin mahir
        $user1 = User::create([
            'nama' => 'Budi Prihanto',
            'username' => 'Budi',
            'email' => 'budiprihanto94@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 4,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $user1->assignRole('user_manager');

        $mm1 = User::create([
            'nama' => 'Muhammad Zulfi Alfianto',
            'username' => 'Zulfi',
            'email' => 'zulfiafn@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 4,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $mm1->assignRole('user');

        $mm2 = User::create([
            'nama' => 'Fatimatur Rohmah',
            'username' => 'Fatim',
            'email' => 'fatimatur98@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'p',
            'id_divisi' => 4,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $mm2->assignRole('user');

        $mm2 = User::create([
            'nama' => 'Sangadji Nugroho',
            'username' => 'Adji',
            'email' => 'sangadji15@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 4,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $mm2->assignRole('user');

        //DEV
        $user2 = User::create([
            'nama' => 'Akhmad Safii',
            'username' => 'Safii',
            'email' => 'akhmadsafii96@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 5,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $user2->assignRole('user_manager');

        $dev1 = User::create([
            'nama' => 'Hisyam Maulana',
            'username' => 'Hisyam',
            'email' => 'hisyammaulana100@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 5,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $dev1->assignRole('user');

        $user2 = User::create([
            'nama' => 'Mucharom',
            'username' => 'Mucharom',
            'email' => 'mucharom@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 5,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $user2->assignRole('user');

        $user2 = User::create([
            'nama' => 'Rifki',
            'username' => 'Rifki',
            'email' => 'rifki@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 5,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $user2->assignRole('user');

        $user2 = User::create([
            'nama' => 'Feri Alfajri',
            'username' => 'Feri',
            'email' => 'feri.alfajri@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 5,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $user2->assignRole('user');

        //Budimark
        $user3 = User::create([
            'nama' => 'Tommy Indrakusuma',
            'username' => 'Tommy',
            'email' => 'Indraku.tmy@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 2,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);

        $user3->assignRole('user_manager');

        $bd1 = User::create([
            'nama' => 'Miasifa Kartika',
            'username' => 'Shifa',
            'email' => 'miasifa21@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 2,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);

        $bd1->assignRole('user');

        //Support
        $sp = User::create([
            'nama' => 'Achmad Nurfadilah Herdiyanto',
            'username' => 'Achmad',
            'email' => 'somadnol2@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 3,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $sp->assignRole('user');

        $sp1 = User::create([
            'nama' => 'Virda Agustina',
            'username' => 'Virda',
            'email' => 'virdaagustina178@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 3,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $sp1->assignRole('user');

        $hr = User::create([
            'nama' => 'Aldino Radiansyah',
            'username' => 'Aldino',
            'email' => 'AldinoRadiansyah@gmail.com',
            'password' => bcrypt('12345678'),
            'jenkel' => 'p',
            'id_divisi' => 1,
            'foto' => 'asset/img/profile/profile.jpg',
        ]);
        $hr->assignRole('user');


    }
}
