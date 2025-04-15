<?php

namespace App\Livewire\Barang;

use App\Exports\barang_masuksExport;
use App\Imports\barang_masuksImport;
use App\Models\barang_masuk;
use App\Models\produk;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('layouts.master')]
class BarangMasuk extends Component
{
    use WithFileUploads;

    public $file;

    #[Title('barang masuk')]



    public $kode, $qty, $harga, $expired;
    public $barang;
    public $history;


    protected $rules = [
        'kode' => 'required',
        'qty' => 'required',
        'harga' => 'required',
    ];

    public function refreshForm()
    {
        $this->kode = '';
        $this->qty = '';
        $this->harga = '';
        $this->expired = '';
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        Excel::import(new barang_masuksImport, $this->file->getRealPath());

        session()->flash('success', 'Import berhasil!');
    }

    public function export()
    {
        return response()->streamDownload(function () {
            echo Excel::raw(new barang_masuksExport(), \Maatwebsite\Excel\Excel::XLSX);
        }, 'barang_masuk.xlsx');
    }



    public function scanDetected()
    {
        $this->validate();
        $produk = produk::where('kode', $this->kode)->with('barang_masuk')->first();
        if ($produk == null) {
            $data['kode'] = $this->kode;
            return redirect()->route('produk')->with('error', 'Produk tidak ditemukan, silahkan masukan data terlebih dahulu')->with($data);
        }
        if ($produk != null) {
            barang_masuk::create([
                'produk_id' => $produk->id,
                'tgl_masuk' => date('Y-m-d'),
                'harga_modal' => $this->harga,
                'qty' => $this->qty,
                'stok' => $this->qty,
                'expired' => $this->expired ?? null ,
            ]);
            $this->refreshForm();
            session()->flash('success', 'Berhasil memasukan produk!');

            // return redirect('barang-masuk')->with('success', 'Produk berhasil ditambahkan');
        } else {
            return redirect('barang-masuk')->with('error', 'Produk tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        barang_masuk::where('id', $id)->delete();
        session()->flash('success', 'Produk berhasil dihapus!');
    }



    public function render()
    {
        $this->history = barang_masuk::with('produk')->get();
        return view('livewire.barang.barang-masuk')->with('listBarang', $this->history);
    }
}
