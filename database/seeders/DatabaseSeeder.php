<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OkrTrackingSeeder::class);
        $this->call(ObjectiveSeeder::class);
        $this->call(KeyResultUserSeeder::class);
        $this->call(KeyresultSeeder::class);
        $this->call(DivisiSeeder::class);
        $this->call(ListIbadah::class);
    }
}
