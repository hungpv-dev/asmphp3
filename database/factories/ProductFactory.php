<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'price' => $this->faker->numberBetween(100000,1000000),
            'price_seal' => $this->faker->numberBetween(0,20),
            'desc_short' => $this->faker->text(100),
            'desc' => $this->faker->text(200),
            'buy' => $this->faker->numberBetween(1,20),
            'status' => 0
        ];
    }
}
