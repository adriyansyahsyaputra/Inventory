<?php

namespace App\Exports;

use App\Models\StockTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Mengambil koleksi data dari database
     */
    public function collection()
    {
        return StockTransaction::with('category')->get();
    }

    /**
     * Header untuk file Excel
     */
    public function headings(): array
    {
        return [
            'Nama Produk',
            'Kategori',
            'Jenis Transaksi',
            'Jumlah',
            'Deskripsi',
            'Tanggal Transaksi',
        ];
    }

    /**
     * Format setiap baris data
     */
    public function map($transaction): array
    {
        return [
            $transaction->name,
            $transaction->category->name ?? 'Tidak Ada',
            $transaction->type === 'in' ? 'Masuk' : 'Keluar',
            $transaction->quantity,
            $transaction->description,
            $transaction->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
