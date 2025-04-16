<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class formatsExport implements FromCollection, WithHeadings
{
    /**
     * Data dummy (kosong) untuk isi Excel.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Kosong atau bisa isi contoh 1 baris data dummy
        return new Collection([
            // ['1', '2024-01-01', 10000, 5, 5, '2024-12-31'],
        ]);
    }

    /**
     * Header kolom untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'name',
            'password',
        ];
    }
}
