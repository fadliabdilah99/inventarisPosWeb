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
    <div class="col-md-3 col-sm-12 card p-3">
        <button id="stopScan" class="btn btn-danger rounded-pill mb-3" style="display: none">Tutup</button>
        <video id="preview"
            style="width: 100%; height: auto; border: 1px solid black; border-radius: 10px; display: none;"></video>
        <form wire:submit.prevent="scanDetected" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Kode Barang</label>
                        <input readonly id="kode_barang" type="text" class="form-control" placeholder="isi nama barang"
                            wire:model="kode">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group form-group-default">
                        <label>Harga Modal/item</label>
                        <input id="modal" type="number" class="form-control rounded-pill" placeholder="Rp. 0" wire:model="harga">
                    </div>
                    <div class="form-group form-group-default">
                        <label>QTY</label>
                        <input id="modal" type="number" class="form-control rounded-pill" placeholder="0" wire:model="qty">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Expired</label>
                        <input id="modal" type="date" class="form-control rounded-pill" placeholder="00/00/0000" wire:model="expired">
                    </div>
                </div>
            </div>
            <button class="btn btn-success rounded-pill" id="startScan" type="button">Scan</button>
        </form>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">History Barang Masuk</h4>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                                <th>expired</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                                <th>expired</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($listBarang as $history)
                                <tr>
                                    <td>{{$history->produk->produk}}</td>
                                    <td>{{$history->qty}} </td>
                                    <td>{{ number_format($history->harga_modal * $history->qty, 0, ',', '.') }} <br> <span class="text-muted fs-6">{{ number_format($history->harga_modal, 0, ',', '.') }}/{{ $history->produk->satuan }}</span></td>
                                    <td>{{$history->tgl_masuk}}</td>
                                    <td>{{$history->expired}}</td>
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
                            @endforeach
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
