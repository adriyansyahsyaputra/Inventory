<?php

namespace App\Exports;

use App\Models\StockTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
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

    public function styles(Worksheet $sheet)
    {
        // Menambahkan border untuk seluruh data (A1 hingga kolom terakhir dan baris terakhir)
        $sheet->getStyle('A1:F' . $sheet->getHighestRow())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Mengembalikan style tambahan jika diperlukan
        return [
            'A1:F1' => [
                'font' => ['bold' => true], // Bold untuk header
            ],
        ];
    }
}
