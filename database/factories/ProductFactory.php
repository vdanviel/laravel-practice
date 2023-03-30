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
    public function definition(): array
    {
        //product_name	product_price	product_uri	product_image	
        return [
            'product_name' => fake()->word(),
            'product_price' => fake()->randomFloat(2,2,10),
            'product_description' => fake()->text(120),
            'product_uri' => fake()->slug(),
            'product_image' => fake()->imageUrl()
        ];
    }
}
