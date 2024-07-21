<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory()->count(100)->create();

        $categoryIds = Category::pluck('id')->toArray();

        foreach ($products as $product) {
            $image = new Image([
                'url' => 'https://tse3.mm.bing.net/th?id=OIP.fQ9nxARvQPBJP3VLTbfKvwHaE7&pid=Api&P=0&h=220',
                'public_id' => 'test',
            ]);
            $product->images()->save($image);

            $randomKeys = array_rand(array_flip($categoryIds), 3);
            $product->categories()->attach($randomKeys);

            Property::factory()->count(3)->create([
                'product_id' => $product->id,
            ]);
        }
    }
}
