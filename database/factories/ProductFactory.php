<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $names = [
            'Beverages' => ['Cola', 'Sprite', 'Orange Juice', 'Mineral Water', 'Energy Drink'],
            'Snacks' => ['Chips', 'Chocolate Bar', 'Cookies', 'Nuts', 'Popcorn'],
            'Coffee' => ['Espresso', 'Latte', 'Cappuccino', 'Americano', 'Mocha'],
            'Tea' => ['Green Tea', 'Black Tea', 'Jasmine Tea', 'Milk Tea', 'Lemon Tea'],
            'Juices' => ['Apple Juice', 'Mango Juice', 'Grape Juice', 'Pineapple Juice', 'Mixed Fruit'],
        ];

        $categoryNames = array_keys($names);
        $category = fake()->randomElement($categoryNames);
        $productName = fake()->randomElement($names[$category]);

        return [
            'category_id' => Category::where('name', $category)->first()?->id ?? 1,
            'name' => $productName,
            'slug' => fn() => Str::slug($this->faker->unique()->name),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 1.00, 10.00),
            'stock' => fake()->numberBetween(10, 100),
            'is_active' => true,
            'is_featured' => fake()->boolean(30),
        ];
    }
}