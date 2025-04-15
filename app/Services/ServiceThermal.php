<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector; // Atau FilePrintConnector kalau di Linux

class ServiceThermal
{
    public function cetakStruk($transaksi)
    {
        try {
            $connector = new WindowsPrintConnector("POS-51"); // Ganti sesuai printer kamu
            $printer = new Printer($connector);

            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("TokoKu\n");
            $printer->text("SMKN 1 Cianjur, Cianjur\n");
            $printer->text("Telp: 08123456789\n");
            $printer->text(date('d-m-Y H:i') . "\n");
            $printer->feed();

            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("================================\n");

            foreach ($transaksi->item as $item) {
                $nama = $item->produk->produk;
                $qty = $item->qty;
                $harga = number_format($item->produk->margin, 0, ',', '.');
                $total = number_format($item->qty * $item->produk->margin, 0, ',', '.');

                $printer->text("$nama\n");
                $printer->text("$qty x Rp$harga = Rp$total\n");
            }

            $printer->text("================================\n");

            $totals = $transaksi->total;
            $ppn = $totals * 0.11;
            $diskon = 0;

            foreach ($transaksi->item as $item) {
                $diskon += (($item->produk->discount * $item->produk->margin) / 100) * $item->qty;
            }

            $total_bayar = $totals + $ppn - $diskon;

            $printer->text("Subtotal : Rp" . number_format($totals, 0, ',', '.') . "\n");
            $printer->text("Diskon   : Rp" . number_format($diskon, 0, ',', '.') . "\n");
            $printer->text("PPN 11%  : Rp" . number_format($ppn, 0, ',', '.') . "\n");
            $printer->text("TOTAL    : Rp" . number_format($total_bayar, 0, ',', '.') . "\n");

            $printer->feed();
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Terima Kasih\n");
            $printer->text("~ Selesai ~\n");
            $printer->pulse();
            $printer->cut();
            $printer->close();
        } catch (\Exception $e) {
            Log::error('Gagal cetak struk: ' . $e->getMessage());
        }
    }
}
