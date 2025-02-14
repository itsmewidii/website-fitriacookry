<?php
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
     * Ambil data dari database
     */
    public function collection()
    {
        return Order::select('id', 'name', 'email', 'total_qty', 'total_price', 'created_at')->get();
    }

    /**
     * Format data sebelum diekspor
     */
    public function map($order): array
    {
        return [
            $order->id,
            $order->name,
            $order->email,
            $order->total_qty,
            'Rp ' . number_format($order->total_price, 0, ',', '.'), // Format harga
            $order->created_at->format('d-m-Y H:i'), // Format tanggal lebih rapi
        ];
    }

    /**
     * Set judul kolom di Excel
     */
    public function headings(): array
    {
        return ['ID', 'Nama Pesanan', 'Email', 'Total Jumlah', 'Total Harga', 'Tanggal Pesanan'];
    }
}