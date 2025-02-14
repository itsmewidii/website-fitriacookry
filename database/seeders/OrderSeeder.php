<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Unique;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $unique = User::first();

        // if (!$unique) {
        //     throw new \Exception('Tidak ada order yang ditemukan. Pastikan untuk menjalankan UniqueSeeder terlebih dahulu.');
        // }

        // $data = [
        //     [
        //         'id' => (string) Str::uuid(),
        //         'unique_id' => $unique->id,
        //         'name' => 'Pesanan 1',
        //         'no_whatsapp' => 628951611628,
        //         'email' => 'oder2@gmail.com',
        //         'total_qty' => 20,
        //         'total_price' => 20000,
        //         'address' => 'Alamat Order Bogor 2',
        //         'status' => 'PENDING',
        //         'proof_transfer' => 'assets/piper/logo-admin.png',
        //         'shipping_price' => 10000,
        //         'shipping_code' => 'SHIP123',
        //         'shipping' => 'JNE'
        //     ],
        //     [
        //         'id' => (string) Str::uuid(),
        //         'unique_id' => $unique->id,
        //         'name' => 'Pesanan 2',
        //         'no_whatsapp' => 123456789,
        //         'email' => 'oder1@gmail.com',
        //         'total_qty' => 10,
        //         'total_price' => 10000,
        //         'address' => 'Alamat Order Bogor 1',
        //         'status' => 'PROSES',
        //         'proof_transfer' => 'assets/piper/logo-admin.png',
        //         'shipping_price' => 15000,
        //         'shipping_code' => 'SHIP456',
        //         'shipping' => 'SiCepat',
        //     ],
        //     [
        //         'id' => (string) Str::uuid(),
        //         'unique_id' => $unique->id,
        //         'name' => 'Pesanan 3',
        //         'no_whatsapp' => 123456789,
        //         'email' => 'oder1@gmail.com',
        //         'total_qty' => 10,
        //         'total_price' => 10000,
        //         'address' => 'Alamat Order Bogor 1',
        //         'status' => 'DIKIRIM',
        //         'proof_transfer' => 'assets/piper/logo-admin.png',
        //         'shipping_price' => 20000,
        //         'shipping_code' => 'SHIP789',
        //         'shipping' => 'J&T Express'
        //     ],
        //     [
        //         'id' => (string) Str::uuid(),
        //         'unique_id' => $unique->id,
        //         'name' => 'Pesanan 4',
        //         'no_whatsapp' => 628951611628,
        //         'email' => 'oder2@gmail.com',
        //         'total_qty' => 20,
        //         'total_price' => 20000,
        //         'address' => 'Alamat Order Bogor 2',
        //         'status' => 'SELESAI',
        //         'proof_transfer' => 'assets/piper/logo-admin.png',
        //         'shipping_price' => 25000,
        //         'shipping_code' => 'SHIP012',
        //         'shipping' => 'Fitria Cookry',
        //     ],
        // ];

        // foreach ($data as $item) {
        //     Order::create($item);
        // }
    }
}
