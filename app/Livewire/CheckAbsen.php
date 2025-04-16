<?php

namespace App\Livewire;

use App\Models\Karyawan;
use App\Models\RecordAbsensi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.master')]
class CheckAbsen extends Component
{
    public $name, $password;

    public function login()
    {
        $this->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $karyawan = Karyawan::where('name', $this->name)->first();

        if ($karyawan && Hash::check($this->password, $karyawan->password)) {
            Session::put('karyawan_id', $karyawan->id);
            session()->flash('message', 'Login berhasil!');
            return redirect()->route('check-absen');
        } else {
            session()->flash('error', 'Nama atau password salah');
        }
    }

    public function absensi($id)
    {
        // dd($id);
        RecordAbsensi::create([
            'karyawan_id' => $id,
            'status' => 'masuk',
            'waktu_masuk' => date('H:i:s'),
            'waktu_keluar' => null,
        ]);

        session()->flash('success', 'Berhasil melakukan absensi.');
    }

    public function WaktuKeluar($id)
    {
        RecordAbsensi::whereDate('created_at', date('Y-m-d'))->where('karyawan_id', $id)->update(['waktu_keluar' => date('H:i:s')]);
        session()->flash('success', 'Berhasil Set Waktu Keluar.');
    }

    public function render()
    {
        return view('livewire.check-absen', [
            'karyawans' => Karyawan::with('absensi')->find(session('karyawan_id')),
        ]);
    }
}
