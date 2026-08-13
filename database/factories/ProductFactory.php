<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
        return [
            'name' => $this->faker->words(3, true), // Название из 3 слов
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(500, 10000), // Цена от 500 до 10000 (например, от 5 до 100 рублей/рупий)
            'quantity' => $this->faker->numberBetween(0, 50),   // Остаток на складе
        ];
    }
}
