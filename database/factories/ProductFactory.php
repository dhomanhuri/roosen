<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'user_id' => 2,
            'nama' => $this->faker->sentence(mt_rand(5,10)),
            'harga' => 20000,
            'stok' => '10',
            'keterangan' => $this->faker->sentence(mt_rand(20,40)),
            'gambar' => 'productfoto/WjHtvOiRAogmCuccNeAqp2UZ7LjnbZgXh19FIIRn.jpg',
        ];
    }
}
