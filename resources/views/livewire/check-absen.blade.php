<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    
                    {{-- Alert Message --}}
                    @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    {{-- Jika sudah login --}}
                    @if (session()->has('karyawan_id'))
                        <div class="text-center mb-3">
                            <p class="fs-5">Selamat datang, <strong>{{ $karyawans->name }}</strong></p>

                            @php
                                $absenHariIni = $karyawans->absensi()->whereDate('created_at', date('Y-m-d'))->first();
                            @endphp

                            @if ($absenHariIni)
                                @if ($absenHariIni->waktu_keluar)
                                    <div class="alert alert-info">Anda sudah absen keluar</div>
                                @else
                                    <button type="button" wire:click="WaktuKeluar({{ $karyawans->id }})"
                                        class="btn btn-warning w-100">
                                        Absen Keluar
                                    </button>
                                @endif
                            @else
                                <button type="button" wire:click="absensi({{ $karyawans->id }})"
                                    class="btn btn-success w-100">
                                    Absen Masuk
                                </button>
                            @endif
                        </div>
                    @else
                    <h3 class="card-title text-center mb-4">Login Untuk Absen</h3>

                        {{-- Form Login --}}
                        <form wire:submit.prevent="login">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input wire:model="name" type="text" class="form-control" id="name"
                                    placeholder="Masukkan nama">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input wire:model="password" type="password" class="form-control" id="password"
                                    placeholder="Masukkan password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
