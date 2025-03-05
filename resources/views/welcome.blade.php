<div class="row">
    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('dashboard') }}" wire:navigate>
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('barang-masuk') }}" wire:navigate>Barang Masuk</a>
            </li>
        </ul>
    </div>
    <div class="col-md-4">
        <button id="stopScan" style="display: none">Tutup</button>
        <video id="preview"
            style="width: 100%; height: auto; border: 1px solid black; border-radius: 10px; display: none;"></video>
        <form wire:submit.prevent="scanDetected" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Name</label>
                        <input readonly id="kode_barang" type="text" class="form-control" placeholder="fill name"
                            wire:model="kode">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Harga Modal</label>
                        <input id="modal" type="number" class="form-control" placeholder="000" wire:model="harga">
                    </div>
                    <div class="form-group form-group-default">
                        <label>QTY</label>
                        <input id="modal" type="number" class="form-control" placeholder="000" wire:model="qty">
                    </div>

                </div>
            </div>
            <button class="btn btn-success" id="startScan" type="button">Success</button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const video = document.getElementById('preview');
                const startButton = document.getElementById('startScan');
                const stopButton = document.getElementById('stopScan');
                const form = document.querySelector('form');

                let scanner = new Instascan.Scanner({
                    video: video
                });

                startButton.addEventListener('click', function() {
                    Instascan.Camera.getCameras().then(function(cameras) {
                        if (cameras.length > 0) {
                            scanner.start(cameras[0]);
                            video.style.display = 'block';
                            startButton.style.display = 'none';
                            stopButton.style.display = 'inline';
                        } else {
                            console.error('No cameras found.');
                        }
                    }).catch(function(e) {
                        console.error(e);
                    });
                });

                stopButton.addEventListener('click', function() {
                    scanner.stop();
                    video.style.display = 'none';
                    startButton.style.display = 'inline';
                    stopButton.style.display = 'none';
                });

                scanner.addListener('scan', function(content) {
                    console.log(content);
                    document.getElementById('kode_barang').value = content;
                    @this.set('kode', content);
                    @this.call('scanDetected');
                });
            });
        </script>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Kategori</h4>
                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                        data-bs-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Tambah Kategori
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Modal -->
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">Tambah Kategori</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">
                                    Tambahkan Kategori Produk
                                </p>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">{{ session('message') }}</div>
                                @endif
                                <form wire:submit.prevent="store">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>kode</label>
                                                <input id="addName" type="text" class="form-control"
                                                    placeholder="Kode" wire:model="kategori" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="submit" id="addRowButton" class="btn btn-primary">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>testing</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" data-bs-toggle="tooltip" title=""
                                            class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="tooltip" title=""
                                            class="btn btn-link btn-danger" data-original-title="Remove">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($barang)
        <table class="table mt-3">
            <tr>
                <th>Nama Barang</th>
                <td>{{ $barang->nama_barang }}</td>
            </tr>
            <tr>
                <th>Kode Barang</th>
                <td>{{ $barang->kode_barang }}</td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>{{ number_format($barang->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>{{ $barang->stok }}</td>
            </tr>
        </table>
    @endif
</div>

@push('scripts')
    {{-- //   <!-- Datatables --> --}}
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $("#add-row").DataTable({
            pageLength: 5,
        });

        var action =
            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function() {
            $("#add-row")
                .dataTable()
                .fnAddData([
                    $("#addName").val(),
                    action,
                ]);
            $("#addRowModal").modal("hide");
        });
    </script>
@endpush
