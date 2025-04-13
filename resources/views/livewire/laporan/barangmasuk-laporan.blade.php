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
                            <h4 class="card-title">Basic</h4>
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
                                                <td>{{ $barangMasuk->tanggal_masuk }}</td>
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
