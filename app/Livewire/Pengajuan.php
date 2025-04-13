<?php

namespace App\Livewire;

use App\Exports\PengajuansExport;
use App\Models\pengajuan as ModelsPengajuan;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.master')]

// class pengajuan dari member ke toko
class Pengajuan extends Component
{

    // deklarasi variabel
    public $nama_barang, $qty;

    // aturan validasi
    protected $rules = [
        'nama_barang' => 'required|string',
        'qty' => 'required|integer|min:1',
    ];

    // kosongkan form 
    public function resetForm()
    {
        $this->nama_barang = '';
        $this->qty = '';
    }

    /**
     * Menyimpan pengajuan baru ke database.
     */
    public function store()
    {
        // validasi form
        $this->validate();

        // menambahkan pengajuan kedalam database
        try {
            ModelsPengajuan::create([
                'user_id' => Auth::id(),
                'nama_barang' => $this->nama_barang,
                'tgl_pengajuan' => now(),
                'qty' => $this->qty,
                'status' => 0,
            ]);

            // kosongkan form
            $this->resetForm();

            session()->flash('success', 'Pengajuan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Error menambahkan pengajuan: " . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menambahkan pengajuan.');
        }

        // kosongkan form
        $this->resetForm();

        Log::info("User " . Auth::user()->name . " menambahkan pengajuan: {$this->nama_barang} - {$this->qty}");

        session()->flash('success', 'Pengajuan berhasil ditambahkan.');
    }

    /**
     * Mengubah status pengajuan (0 -> 1 atau 1 -> 0).
     */
    public function updateStatus($id)
    {
        // mengambil data pengajuan sesuai id untuk di ubah
        $pengajuan = ModelsPengajuan::findOrFail($id);
        // ubah status
        $pengajuan->status = !$pengajuan->status;
        // simpan perubahan
        $pengajuan->save();

        Log::info("User " . Auth::user()->name . " mengubah status pengajuan ID {$id} menjadi {$pengajuan->status}");
    }

    /**
     * Menghapus pengajuan berdasarkan ID.
     */
    public function destroy($id)
    {
        // mengambil data pengajuan sesuai id untuk di hapus
        $pengajuan = ModelsPengajuan::findOrFail($id);
        $pengajuan->delete();

        Log::info("User " . Auth::user()->name . " menghapus pengajuan ID {$id}");

        session()->flash('success', 'Pengajuan berhasil dihapus.');
    }

    /**
     * Mengekspor data pengajuan ke format Excel.
     */
    public function exportExcel()
    {
        Log::info("User " . Auth::user()->name . " mengekspor pengajuan ke Excel");
        return response()->streamDownload(function () {
            echo Excel::raw(new PengajuansExport(), \Maatwebsite\Excel\Excel::XLSX);
        }, 'pengajuan.xlsx');
    }

    /**
     * Mengekspor data pengajuan ke format PDF.
     */
    public function exportPdf()
    {
        Log::info("User " . Auth::user()->name . " mengekspor pengajuan ke PDF");
        return redirect()->route('download.pdf');
    }

    public function updatePengajuan($id, $field, $value)
    {
        $pengajuan = ModelsPengajuan::findOrFail($id);
        $pengajuan->$field = $value;
        $pengajuan->save();
    }

    /**
     * Render halaman pengajuan dengan data dari database.
     */
    public function render()
    {
        return view('livewire.pengajuan', [
            // mengirim data penjualan
            'pengajuans' => ModelsPengajuan::latest()->get(),
        ]);
    }
}
