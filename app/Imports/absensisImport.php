<?php

namespace App\Imports;

use App\Models\absensi;
use App\Models\Karyawan;
use App\Models\RecordAbsensi;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class absensisImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Karyawan([
            'name' => $row['name'],
            'password' => Hash::make($row['password']),
        ]);
    }
}
