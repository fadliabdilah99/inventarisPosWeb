<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Edit Karyawan</h4>
                        <button class="btn btn-primary btn-round ms-auto" wire:click="closeModal()">
                            Kembali
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="update" method="POST">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input id="nama" wire:model="name" value="{{ $name }}" type="text"
                                        class="form-control" placeholder="Masukan Nama" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambahkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                window.livewire.on('alert', (message) => {
                    alert(message);
                });

                window.livewire.on('error', (message) => {
                    alert(message);
                });
            });
        </script>
    @endsection
