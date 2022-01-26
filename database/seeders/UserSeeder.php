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
            'name' => 'Aldino',
            'username' => 'Aldino',
            'email' => 'Aldino@gmail.id',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 1,
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Syifa',
            'username' => 'syifa',
            'email' => 'syifa@gmail.id',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 2,
        ]);

        $user->assignRole('user');

        $user1 = User::create([
            'name' => 'Naili',
            'username' => 'naili',
            'email' => 'naili@gmail.id',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 3,
        ]);

        $user1->assignRole('user');

        $user2 = User::create([
            'name' => 'Budi',
            'username' => 'Budi',
            'email' => 'budi@gmail.id',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 4,
        ]);

        $user2->assignRole('user');

        $user3 = User::create([
            'name' => 'Hisyam',
            'username' => 'Hisyam',
            'email' => 'Hisyam@gmail.id',
            'password' => bcrypt('12345678'),
            'jenkel' => 'l',
            'id_divisi' => 5,
        ]);

        $user3->assignRole('user');
    }
}
