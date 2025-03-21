<?php

namespace App\Exports;

use App\Models\pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengajuansExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return pengajuan::all();
    }
}
