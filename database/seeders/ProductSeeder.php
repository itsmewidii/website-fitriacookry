<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Categorie::first();

        if (!$category) {
            throw new \Exception('Tidak ada kategori yang ditemukan. Pastikan untuk menjalankan CategorieSeeder terlebih dahulu.');
        }

        $data = [
            [
                'id' => (string) Str::uuid(),
                'category_id' => $category->id,
                'name' => 'Product 1',
                'price' => 10000,
                'qty' => 10,
                'status' => 'active',
                'description' => 'Description untuk Product 1',
                'image' => 'data/product/product.png',
            ],
            [
                'id' => (string) Str::uuid(),
                'category_id' => $category->id,
                'name' => 'Product 2',
                'price' => 20000,
                'qty' => 15,
                'status' => 'non-active',
                'description' => 'Description untuk Product 2',
                'image' => 'data/product/product.png',
            ],
        ];

        foreach ($data as $item) {
            Product::create($item);
        }
    }
}
