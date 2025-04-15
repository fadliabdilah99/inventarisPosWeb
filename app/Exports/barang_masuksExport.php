<?php

namespace App\Exports;

use App\Models\barang_masuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class barang_masuksExport implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return barang_masuk::all();
    }

    public function headings(): array
    {
        return [
            'produk_id',
            'tgl_masuk',
            'harga_modal',
            'qty',
            'stok',
            'expired',
            'Quantity'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Gaya untuk baris heading
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4CAF50']]
            ],
            // Gaya untuk isi table
            2 => [
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'F5F5DC']]
            ]
        ];
    }
}
