<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regulation;
use Illuminate\Support\Str;

class RegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => (string) Str::uuid(),
                'description' => 'Description untuk Regulation',
                'rek_no' => '088214407298',
                'rek_name' => 'Tri Widya Ningsih',
                'bank' => 'Bank Central Asia (BCA)',
            ]
        ];

        foreach ($data as $item) {
            Regulation::create($item);
        }
    }
}
