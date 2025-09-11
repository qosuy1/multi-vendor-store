<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;
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
        $name = fake()->productName;
        $categoriesIds = Category::pluck('id')->toArray();
        $storesIds = Store::pluck('id')->toArray();
        $statusArray = [
            'active',
            'draft',
            'archived'
        ];

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(15),
            'image' => $this->faker->imageUrl(800, 600),
            'price' => $this->faker->randomFloat(1, 1, 499),
            'compare_price' => $this->faker->randomFloat(1, 500, 999),
            'category_id' => $categoriesIds[array_rand($categoriesIds)],
            'store_id' => $storesIds[array_rand($storesIds)],
            'featured' => rand(0, 1),
            'status' => $statusArray[array_rand($statusArray)]
        ];
    }
}
