<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        Product::factory(100)->create();

        // \App\Models\User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'role' => 'admin',
        //     'foto' => 'default.jpeg',
        //     'password' => bcrypt('ugans123'),
        // ]);
        // \App\Models\User::create([
        //     'name' => 'Muhammad Imam',
        //     'email' => 'saitamasensei2005@gmail.com',
        //     'role' => 'petani',
        //     'foto' => 'userfoto/jZjV2DPNTiaeQCAEFFJSawdYCVuNCNV7zh6Mb8Jl.jpg',
        //     'password' => bcrypt('ugans123'),
        // ]);
    }
}
