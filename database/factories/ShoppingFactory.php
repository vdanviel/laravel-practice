<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shopping>
 */
class ShoppingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shopping_cart' => Cart::pluck('cart_id')->random(),
            'shopping_product' => Product::pluck('product_id')->random(),
            'shopping_date' => now()
        ];
    }
}
