<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil kategori berdasarkan ID
        $category1 = Category::find(1); 
        $category2 = Category::find(2); 
        $category3 = Category::find(4); 
        $category4 = Category::find(5);

        Product::create([
            'product_code' => Product::generateProductCode($category1->name),
            'category_id' => 1,
            'name' => 'Gaming Mouse',
            'description' => 'High-precision gaming mouse with customizable buttons.',
            'price' => 300000,
            'stock' => 70,
            'entry_date' => now(),
            'image' => 'mouse.jpg',
        ]);

        Product::create([
            'product_code' => Product::generateProductCode($category2->name),
            'category_id' => 2,
            'name' => 'Bluetooth Speaker',
            'description' => 'Compact Bluetooth speaker with excellent sound quality.',
            'price' => 500000,
            'stock' => 30,
            'entry_date' => now(),
            'image' => 'bluetooth-speaker.jpg',
        ]);

        Product::create([
            'product_code' => Product::generateProductCode($category3->name),
            'category_id' => 4,
            'name' => 'USB Flash Drive',
            'description' => '64GB USB 3.0 flash drive with fast transfer speeds.',
            'price' => 150000,
            'stock' => 100,
            'entry_date' => now(),
            'image' => 'usb.jpg',
        ]);

        Product::create([
            'product_code' => Product::generateProductCode($category4->name),
            'category_id' => 5,
            'name' => 'External Hard Drive',
            'description' => '1TB external hard drive for secure data storage.',
            'price' => 1200000,
            'stock' => 25,
            'entry_date' => now(),
            'image' => 'hard-drive.jpg',
        ]);

        Product::create([
            'product_code' => Product::generateProductCode($category3->name),
            'category_id' => 4,
            'name' => 'Smartphone Stand',
            'description' => 'Adjustable smartphone stand for hands-free use.',
            'price' => 100000,
            'stock' => 200,
            'entry_date' => now(),
            'image' => 'stand-phone.jpg',
        ]);

        Product::create([
            'product_code' => Product::generateProductCode($category4->name),
            'category_id' => 5,
            'name' => 'Portable Charger',
            'description' => '10,000mAh portable charger with fast charging support.',
            'price' => 350000,
            'stock' => 40,
            'entry_date' => now(),
            'image' => 'portable-charger.jpg',
        ]);

        Product::create([
            'product_code' => Product::generateProductCode($category3->name),
            'category_id' => 4,
            'name' => 'Monitor Screen Cleaner',
            'description' => 'Anti-static screen cleaner for monitors and laptops.',
            'price' => 50000,
            'stock' => 150,
            'entry_date' => now(),
            'image' => 'screen-cleaner.jpg',
        ]);

        Product::create([
            'product_code' => Product::generateProductCode($category4->name),
            'category_id' => 5,
            'name' => 'Ergonomic Office Chair',
            'description' => 'Comfortable ergonomic chair for long working hours.',
            'price' => 2500000,
            'stock' => 10,
            'entry_date' => now(),
            'image' => 'chair.jpg',
        ]);

        Product::create([
            'product_code' => Product::generateProductCode($category4->name),
            'category_id' => 5,
            'name' => 'Wireless Keyboard',
            'description' => 'A sleek wireless keyboard with long-lasting battery.',
            'price' => 250000,
            'stock' => 50,
            'entry_date' => now(),
            'image' => 'keyboard.jpg',
        ]);
    }
}
