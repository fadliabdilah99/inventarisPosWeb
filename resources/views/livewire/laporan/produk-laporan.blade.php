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
                        <a href="#">Produk</a>
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
                                            <th>Name <br> <span style="font-size: 10px">(kategori / Kode)</span></th>
                                            <th>stok</th>
                                            <th>AVG Modal</th>
                                            <th>Harga Jual</th>
                                            <th>disc %</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name <br> <span style="font-size: 10px">(kategori / Kode)</span></th>
                                            <th>stok</th>
                                            <th>AVG Modal</th>
                                            <th>Harga Jual</th>
                                            <th>disc %</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($produks as $prod)
                                            <tr>
                                                <td>{{ $prod->produk }} <br> <span
                                                        style="font-size: 10px">({{ $prod->kategori->kategori }} /
                                                        {{ $prod->kode }})</span>
                                                </td>
                                                <td>{{ $prod->barang_masuk->sum('stok') . ' ' . $prod->satuan }}</td>
                                                <td>{{ 'Rp. ' . number_format($prod->barang_masuk->sum(fn($barang) => $barang->stok * $barang->harga_modal) / max($prod->barang_masuk->sum('stok'), 1), 0, ',', '.') }}
                                                </td>
                                                <td>{{ 'Rp. ' . number_format($prod->harga_jual, 0, ',', '.') }}</td>
                                                <td>{{ $prod->discount }} %</td>
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
