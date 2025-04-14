<div>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Laporan</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="{{ route('dashboard') }}">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Laporan</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Barang Masuk</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Filter</h4>
                                <form wire:submit.prevent="filter" class="d-flex">
                                    <div class="form-group me-2">
                                        <label for="from_date" class="visually-hidden">Dari Tanggal</label>
                                        <input type="date" id="from_date" wire:model="from_date" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group me-2">
                                        <label for="to_date" class="visually-hidden">Sampai Tanggal</label>
                                        <input type="date" id="to_date" wire:model="to_date" class="form-control"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>tanggal Masuk</th>
                                            <th>Harga Modal</th>
                                            <th>QTY</th>
                                            <th>expired</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Produk</th>
                                            <th>tanggal Masuk</th>
                                            <th>Harga Modal</th>
                                            <th>QTY</th>
                                            <th>expired</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($barang_masuk as $barangMasuk)
                                            <tr>
                                                <td>{{ $barangMasuk->produk->produk }}</td>
                                                <td>{{ $barangMasuk->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $barangMasuk->harga_modal }}</td>
                                                <td>{{ $barangMasuk->qty }}</td>
                                                <td>{{ $barangMasuk->expired }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
@endpush
