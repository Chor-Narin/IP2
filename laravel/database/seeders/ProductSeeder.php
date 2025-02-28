<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'iPhone 15',
                'category_id' => 1,
                'pricing' => 999.99,
                'description' => 'Latest Apple phone with advanced features.',
                'images' => json_encode(['iphone15_front.jpg', 'iphone15_back.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S23',
                'category_id' => 2,
                'pricing' => 899.99,
                'description' => 'Samsung flagship phone with excellent camera quality.',
                'images' => json_encode(['galaxy_s23_front.jpg', 'galaxy_s23_back.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Google Pixel 7',
                'category_id' => 2,
                'pricing' => 799.99,
                'description' => 'Google Pixel phone with the best camera performance.',
                'images' => json_encode(['pixel7_front.jpg', 'pixel7_back.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy',
                'category_id' => 2,
                'pricing' => 799.99,
                'description' => 'Google Pixel phone with the best camera performance.',
                'images' => json_encode(['pixel7_front.jpg', 'pixel7_back.jpg']),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
