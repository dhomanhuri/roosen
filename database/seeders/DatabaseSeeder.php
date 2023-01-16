<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
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

        // User::factory(100)->create();

        // Product::factory(100)->create();

        // Cart::factory(100)->create();

        $this->call(CouriersTableSeeder::class);
        $this->call(LocationsTableSeeder::class);

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'foto' => 'default.jpeg',
            'password' => bcrypt('ugans123'),
        ]);
    }
}
