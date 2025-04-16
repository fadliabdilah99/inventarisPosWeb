<?php

namespace App\Exports;

use App\Models\absensi;
use App\Models\RecordAbsensi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class absensisExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('record_absensis')
            ->select('karyawans.name as karyawan', 'record_absensis.status', 'record_absensis.waktu_masuk', 'record_absensis.waktu_keluar')
            ->join('karyawans', 'record_absensis.karyawan_id', '=', 'karyawans.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Karyawan',
            'Status',
            'Waktu Masuk',
            'Waktu Keluar'
        ];
    }
}
