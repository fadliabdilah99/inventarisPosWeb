<?php

namespace App\Http\Controllers;

use App\Models\pengajuan;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function generatePdf()
    {
        $data = pengajuan::all(); // Ambil data dari database

        $html = view('export.pdf', compact('data'))->render();

        // Konfigurasi DomPDF
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isHtml5ParserEnabled', true);

        // Inisialisasi DomPDF
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Kembalikan file PDF untuk di-download atau ditampilkan di browser
        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="pengajuan.pdf"',
        ]);
    }
}
