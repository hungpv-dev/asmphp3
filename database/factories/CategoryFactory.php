<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $parentIds = Category::pluck('id')->toArray(); // Lấy danh sách các id của bản ghi đã tồn tại

        return [
            'name' => $this->faker->name,
            'parent_id' => $this->faker->boolean(50) ? null : $this->faker->randomElement($parentIds),
            'status' => rand(0,1)
        ];
    }
}
