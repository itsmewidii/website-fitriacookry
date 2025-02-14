<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;
use Illuminate\Support\Str;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => (string) Str::uuid(),
                'name' => 'Categori testing 1',
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Categori testing 2',
            ]
        ];

        foreach ($data as $item) {
            Categorie::create($item);
        }
    }
}
