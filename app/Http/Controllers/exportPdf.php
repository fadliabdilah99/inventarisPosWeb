<?php

namespace App\Http\Controllers;

use App\Models\RecordAbsensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class exportPdf extends Controller
{
    public function exportPdf()
    {
        $data = RecordAbsensi::with('karyawan')->get(); // sesuaikan relasi jika ada

        // return view('export.absensi', compact('data'));
        $pdf = Pdf::loadView('export.absensi', compact('data'));
        return $pdf->download('barang_masuk.pdf');
    }
}
