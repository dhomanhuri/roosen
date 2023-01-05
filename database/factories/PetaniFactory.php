<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PetaniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'role' => 'petani',
            'foto' => 'userfoto/2N0xWBnFAV9Gv2lDbyq7ctIS0Qwi1RaT4mCyeG2O.jpg',
            'alamat_rumah' => 'Jalan anggada wendit timur no 38 kecamatan pakis kabupaten malang',
            'alamat_lahan' => 'Jalan anggada wendit timur no 38 kecamatan kedungkandang kabupaten lumajang',
            'luas_lahan' => '120',
            'jenis_tanaman' => 'Mangrove',
            'password' => bcrypt('ugans123'),
        ];
    }
}
