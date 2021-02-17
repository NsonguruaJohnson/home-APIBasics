<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleTableSeeder;   # Not necessary since they're in the same namespace with Database\Seeders
use Database\Seeders\UserTableSeeder;   # Not necessary since they're in the same namespace with Database\Seeders

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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
