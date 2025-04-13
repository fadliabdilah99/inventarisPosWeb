<div>
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
                <a href="{{ route('penjualan') }}" wire:navigate>Penjualan</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="" wire:navigate>list</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-center">Scan Barcode</h5>
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-center">
                        <video id="preview" class="w-100 border border-dark rounded-3"></video>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex justify-content-center">
                        <form wire:submit.prevent="addlist" method="POST" class="w-100">
                            @csrf
                            <input type="text" wire:model="produk_id" id="produk_id" class="form-control mt-2"
                                placeholder="Kode Produk">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List Transaksi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($list_transaksi as $index => $list)
                                    <tr>
                                        <td>{{ $list->produk->produk }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <input type="number" class="form-control" value="{{ $list->qty }}"
                                                    wire:model.lazy="list_transaksi.{{ $index }}.qty"
                                                    wire:change="updateList({{ $list->id }}, 'qty', $event.target.value)">
                                            </div>
                                        </td>
                                        <td>{{ $list->produk->margin }}</td>
                                        <td>{{ $discount += (($list->produk->discount * $list->produk->margin) / 100) * $list->qty }}
                                        </td>
                                        <td>{{ $total += $list->qty * $list->produk->margin }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Payment</div>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="d-flex">
                                        <div class="flex-1 pt-1 ms-2">
                                            <h6 class="fw-bold mb-1">Total belanja</h6>
                                        </div>
                                        <div class="d-flex ms-auto align-items-center">
                                            <h4 class="text-info fw-bold">Rp {{ number_format($total) }}</h4>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="flex-1 pt-1 ms-2">
                                            <h6 class="fw-bold mb-1">Discount</h6>
                                        </div>
                                        <div class="d-flex ms-auto align-items-center">
                                            <h4 class="text-info fw-bold">Rp {{ number_format($discount) }}</h4>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="flex-1 pt-1 ms-2">
                                            <h6 class="fw-bold mb-1">PPN 11%</h6>
                                        </div>
                                        <div class="d-flex ms-auto align-items-center">
                                            <h4 class="text-info fw-bold">Rp {{ number_format($tax = $total * 0.11) }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    <div class="d-flex">
                                        <div class="flex-1 pt-1 ms-2">
                                            <h6 class="fw-bold mb-1">Total Bayar</h6>
                                        </div>
                                        <div class="d-flex ms-auto align-items-center">
                                            <h4 class="text-danger fw-bold">Rp
                                                {{ number_format($total + $tax - $discount) }}</h4>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="No member"
                                            style="width: 33.33%" wire:change="add_member($event.target.value)">
                                        <input type="text" class="form-control" placeholder="Uang bayar"
                                            id="uang_bayar" style="width: 33.33%" onchange="hitung_kembalian()">
                                        <input type="number" class="form-control" placeholder="Kembalian"
                                            id="kembalian" style="width: 33.33%" readonly>
                                    </div>


                                    <div class="separator-dashed"></div>
                                    <button class="btn btn-info" wire:click="bayar">konfirmasi</button>
                                    <div class="pull-in">
                                        <canvas id="topProductsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('preview');
            const form = document.querySelector('form');

            let scanner = new Instascan.Scanner({
                video: video
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    // video.style.display = 'block';

                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });
            scanner.addListener('scan', function(content) {
                console.log(content);
                document.getElementById('produk_id').value = content;
                @this.set('produk_id', content);
                @this.call('addlist');
            });
        });
    </script>

    {{-- mengtung kembalian --}}
    <script>
        function hitung_kembalian() {
            let uang_bayar = parseInt(document.getElementById('uang_bayar').value);
            let total_bayar = parseInt({{ $total + $tax - $discount }});
            let kembalian = uang_bayar - total_bayar;
            document.getElementById('kembalian').value = kembalian;
        }
    </script>
@endpush
