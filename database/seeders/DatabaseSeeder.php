<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = [
            ['name' => 'Beverages', 'slug' => 'beverages', 'description' => 'Refreshing drinks and sodas', 'sort_order' => 1],
            ['name' => 'Snacks', 'slug' => 'snacks', 'description' => 'Delicious snacks and treats', 'sort_order' => 2],
            ['name' => 'Coffee', 'slug' => 'coffee', 'description' => 'Premium coffee drinks', 'sort_order' => 3],
            ['name' => 'Tea', 'slug' => 'tea', 'description' => 'Various tea selections', 'sort_order' => 4],
            ['name' => 'Juices', 'slug' => 'juices', 'description' => 'Fresh fruit juices', 'sort_order' => 5],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $products = [
            ['name' => 'Cola', 'price' => 2.50, 'category_id' => 1, 'is_featured' => true],
            ['name' => 'Sprite', 'price' => 2.50, 'category_id' => 1],
            ['name' => 'Mineral Water', 'price' => 1.50, 'category_id' => 1],
            ['name' => 'Energy Drink', 'price' => 4.00, 'category_id' => 1, 'is_featured' => true],
            ['name' => 'Potato Chips', 'price' => 3.00, 'category_id' => 2, 'is_featured' => true],
            ['name' => 'Chocolate Bar', 'price' => 2.00, 'category_id' => 2],
            ['name' => 'Cookies Pack', 'price' => 3.50, 'category_id' => 2],
            ['name' => 'Mixed Nuts', 'price' => 5.00, 'category_id' => 2],
            ['name' => 'Espresso', 'price' => 3.50, 'category_id' => 3, 'is_featured' => true],
            ['name' => 'Latte', 'price' => 4.50, 'category_id' => 3],
            ['name' => 'Cappuccino', 'price' => 4.00, 'category_id' => 3],
            ['name' => 'Americano', 'price' => 3.00, 'category_id' => 3],
            ['name' => 'Green Tea', 'price' => 2.50, 'category_id' => 4],
            ['name' => 'Black Tea', 'price' => 2.00, 'category_id' => 4],
            ['name' => 'Milk Tea', 'price' => 3.50, 'category_id' => 4, 'is_featured' => true],
            ['name' => 'Jasmine Tea', 'price' => 2.50, 'category_id' => 4],
            ['name' => 'Apple Juice', 'price' => 3.50, 'category_id' => 5, 'is_featured' => true],
            ['name' => 'Mango Juice', 'price' => 4.00, 'category_id' => 5],
            ['name' => 'Orange Juice', 'price' => 3.50, 'category_id' => 5],
            ['name' => 'Mixed Fruit Juice', 'price' => 4.50, 'category_id' => 5],
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);
            $product['description'] = 'Delicious ' . strtolower($product['name']) . ' for your enjoyment';
            Product::create($product);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@npia.drink',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
    }
}