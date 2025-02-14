<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unique;
use Illuminate\Support\Str;

class UniqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => (string) Str::uuid(),
                'code' => 'UNQ001',
                'info' => 'Bogor Jawabarat',
                'lat' => '-6.200000',
                'long' => '106.816666',
            ],
            [
                'id' => (string) Str::uuid(),
                'code' => 'UNQ002',
                'info' => 'Jakarta Selatan',
                'lat' => '-6.21462',
                'long' => '106.84513',
            ],
        ];

        // Iterasi dan buat data ke dalam tabel uniques
        foreach ($data as $item) {
            Unique::create($item);
        }
    }
}
