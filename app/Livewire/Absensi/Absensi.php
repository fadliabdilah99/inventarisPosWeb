<?php

namespace App\Livewire\Absensi;

use App\Exports\absensisExport;
use App\Exports\formatsExport;
use App\Imports\absensisImport;
use App\Models\Karyawan;
use App\Models\RecordAbsensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithFileUploads as LivewireWithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

/**
 * @class Absensi
 * @brief Komponen Livewire untuk manajemen absensi karyawan.
 * 
 * Fitur:
 * - Tambah, ubah, dan hapus karyawan
 * - Proses absensi masuk dan keluar
 * - Import dan export data absensi via Excel
 * - Export PDF (bisa ditambahkan)
 */
#[Layout('layouts.master')]
class Absensi extends Component
{
    use LivewireWithFileUploads;

    /** @var \Livewire\TemporaryUploadedFile|null File Excel yang diunggah */
    public $file;

    /** @var string|null Nama karyawan */
    public $name;
    /** @var string|null Nama password */
    public $password;

    /** @var int|null ID karyawan yang sedang diproses */
    public $karyawanId;

    /** @var string|null Status absensi (hadir, sakit, cuti, dll) */
    public $status;

    /** @var bool Menampilkan modal edit */
    public $modal = false;

    /**
     * Validasi form input.
     * 
     * @var array
     */
    protected $rules = [
        'name' => 'required',
    ];

    /**
     * Reset nilai form.
     */
    public function resetForm()
    {
        $this->name = '';
    }

    /**
     * Menyimpan karyawan baru ke database.
     */
    public function store()
    {
        $this->validate();
        karyawan::create([
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);
        $this->resetForm();
        session()->flash('success', 'Karyawan berhasil ditambahkan.');
    }

    /**
     * Menampilkan modal edit dengan data karyawan.
     * 
     * @param int $id ID karyawan
     */
    public function ShowModal($id)
    {
        $this->karyawanId = $id;
        $this->name = Karyawan::find($id)->name;
        $this->modal = true;
    }

    /**
     * Menutup modal dan redirect ke halaman absensi.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function closeModal()
    {
        $this->modal = false;
        return redirect()->route('absensi');
    }

    /**
     * Melakukan proses absensi masuk.
     * 
     * @param int $id ID karyawan
     */
    public function absensi($id)
    {

        if ($this->status == 'sakit' || $this->status == 'cuti') {
            $waktu_masuk = "00:00:00";
            $waktu_keluar = "00:00:00";
        } else {
            $waktu_masuk = date('H:i:s');
        }

        RecordAbsensi::create([
            'karyawan_id' => $id,
            'status' => $this->status,
            'waktu_masuk' => $waktu_masuk,
            'waktu_keluar' => $waktu_keluar ?? null,
        ]);

        session()->flash('success', 'Berhasil melakukan absensi.');
    }

    /**
     * Set waktu keluar absensi untuk karyawan.
     */
    public function WaktuKeluar()
    {
        RecordAbsensi::whereDate('created_at', date('Y-m-d'))->where('karyawan_id', $this->karyawanId)->update(['waktu_keluar' => date('H:i:s')]);
        session()->flash('success', 'Berhasil Set Waktu Keluar.');
    }

    /**
     * Mengupdate data nama karyawan.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        Log::info($this->name);
        karyawan::find($this->karyawanId)->update([
            'name' => $this->name,
        ]);
        return redirect()->route('absensi')->with('success', 'Karyawan berhasil diupdate.');
    }

    /**
     * Menghapus karyawan dari database.
     */
    public function delete()
    {
        karyawan::find($this->karyawanId)->delete();
        RecordAbsensi::where('karyawan_id', $this->karyawanId)->delete();
        session()->flash('success', 'Karyawan berhasil dihapus.');
    }

    /**
     * Mengimpor data absensi dari file Excel.
     */
    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new absensisImport, $this->file->getRealPath());

        session()->flash('success', 'Import berhasil!');
        $this->reset('file');
    }



    /**
     * Mengekspor data absensi ke file Excel.
     * 
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        return response()->streamDownload(function () {
            echo Excel::raw(new absensisExport(), \Maatwebsite\Excel\Excel::XLSX);
        }, 'DataAbsensi.xlsx');
    }
    public function format()
    {
        return response()->streamDownload(function () {
            echo Excel::raw(new formatsExport(), \Maatwebsite\Excel\Excel::XLSX);
        }, 'format.xlsx');
    }

    /**
     * Menampilkan komponen Livewire dengan daftar karyawan & absensi.
     * 
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.absensi.absensi', [
            'absensis' => Karyawan::with('absensi')->get(),
        ]);
    }
}
