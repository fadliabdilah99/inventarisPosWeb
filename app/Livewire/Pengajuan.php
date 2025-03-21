<?php

namespace App\Livewire;

use App\Models\pengajuan as ModelsPengajuan;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.master')]
class Pengajuan extends Component
{
    public $nama_barang, $qty;

    protected $rules = [
        'nama_barang' => 'required',
        'qty' => 'required',
    ];

    public function updateTerpenuhi($id)
    {
        $pengajuan = ModelsPengajuan::find($id);
        if ($pengajuan->status == 0) {
            $pengajuan->status = 1;
            $pengajuan->save();
        } else {
            $pengajuan->status = 0;
            $pengajuan->save();
        }
    }

    public function destroy($id)
    {
        $pengajuan = ModelsPengajuan::find($id);
        $pengajuan->delete();
    }

    public function store()
    {
        $this->validate();
        ModelsPengajuan::create([
            'user_id' => Auth::user()->id,
            'nama_barang' => $this->nama_barang,
            'tgl_pengajuan' => now(),
            'qty' => $this->qty,
            'status' => 0,
        ]);
    }



    public function exportPdf()
    {
        return redirect()->to(route('download.pdf'));
    }



    public function render()
    {
        $data['pengajuans'] = ModelsPengajuan::get();
        return view('livewire.pengajuan')->with($data);
    }
}
