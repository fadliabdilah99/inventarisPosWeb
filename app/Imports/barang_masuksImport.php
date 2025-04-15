<?php

namespace App\Imports;

use App\Models\barang_masuk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class barang_masuksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new barang_masuk([
            'produk_id'    => $row['produk_id'],
            'tgl_masuk'    => Date::excelToDateTimeObject($row['tgl_masuk']),
            'harga_modal'  => $row['harga_modal'],
            'qty'          => $row['qty'],
            'stok'         => $row['stok'],
            'expired'      => Date::excelToDateTimeObject($row['expired']),
        ]);
    }
}
