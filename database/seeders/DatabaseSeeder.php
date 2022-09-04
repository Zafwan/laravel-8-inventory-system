<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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

        User::create([
            'name' => 'Zafwan',
            'email' => 'zafwanzaf@gmail.com',
            'password' => bcrypt('12345678'),
            'role_id' => 1,
        ]);
    }
}
