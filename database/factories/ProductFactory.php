<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => $this->faker->words(3, true),
            "description" => $this->faker->sentence(10),
            "price" => $this->faker->randomFloat(2, 10000, 100000),
            "stock" => $this->faker->numberBetween(0, 100),
        ];
    }
}
