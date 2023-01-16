<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['code' => 'JNE','title' => 'JNE'],
            ['code' => 'pos','title' => 'POS'],
            ['code' => 'tiki','title' => 'tiki'],
        ];

        Courier::insert($data);
    }
}
