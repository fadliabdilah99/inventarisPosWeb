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
                <a href="{{ route('produk') }}" wire:navigate>Forms</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Produk</h4>
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Tambah Produk
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Modal -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title">
                                        <span class="fw-mediumbold">Tambah Produk</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif
                                    <form wire:submit.prevent='store' method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="">
                                                    <div class="mb-3">
                                                        <label for="kode" class="form-label">Kode Produk</label>
                                                        <input type="text" id="kode" wire:model="kode"
                                                            class="form-control">
                                                        @error('kode')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email2">Nama produk</label>
                                                        <input type="text" wire:model="produk" class="form-control"
                                                            placeholder="nama produk">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect2">Kategori</label>
                                                        <select class="form-select" wire:model="kat">
                                                            <option value="" selected>Pilih Kategori</option>
                                                            @foreach ($kategoris as $kategori)
                                                                <option value="{{ $kategori->id }}">
                                                                    {{ $kategori->kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Satuan</label>
                                                        <select class="form-select" wire:model="satuan">
                                                            <option value="" selected>Pilih Satuan</option>
                                                            <option value="pcs">pcs</option>
                                                            <option value="Box">Box</option>
                                                            <option value="Renceng">Renceng</option>
                                                            <option value="Set">Set</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email2">Margin</label>
                                                        <input type="number" wire:model="margin" class="form-control"
                                                            placeholder="Rp ...">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email2">discount</label>
                                                        <input type="number" wire:model="discount" class="form-control"
                                                            placeholder="xx%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-action">
                                            <button class="btn btn-success">Submit</button>
                                            <button class="btn btn-danger">Cancel</button>
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
                                    <th>Name <br> <span style="font-size: 10px">(kategori / Kode)</span></th>
                                    <th>stok</th>
                                    <th>AVG Modal</th>
                                    <th>Harga Jual</th>
                                    <th>disc %</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $index => $prod)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="text-muted text-ms mt-1">{{ $prod->kategori->kategori . ' / ' . $prod->kode }}</span>
                                                <input type="text" class="form-control" value="{{ $prod->produk }}"
                                                    wire:model.lazy="produks.{{ $index }}.produk"
                                                    wire:change="updateProduk({{ $prod->id }}, 'produk', $event.target.value)">
                                            </div>
                                        </td>
                                        <td>{{ $prod->barang_masuk->sum('stok') . ' ' . $prod->satuan }}</td>
                                        <td class="text-end">
                                            {{ 'Rp. ' . number_format($prod->barang_masuk->sum(fn($barang) => $barang->stok * $barang->harga_modal) / max($prod->barang_masuk->sum('stok'), 1), 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <input type="number" class="form-control" value="{{ $prod->margin }}"
                                                    wire:model.lazy="produks.{{ $index }}.margin"
                                                    wire:change="updateProduk({{ $prod->id }}, 'margin', $event.target.value)">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <input type="number" class="form-control" value="{{ $prod->discount }}"
                                                    wire:model.lazy="produks.{{ $index }}.discount"
                                                    wire:change="updateProduk({{ $prod->id }}, 'discount', $event.target.value)">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="tooltip"
                                                    class="btn btn-link btn-primary btn-lg" title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="tooltip"
                                                    class="btn btn-link btn-danger" title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
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

@push('scripts')
    {{-- //   <!-- Datatables --> --}}
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>

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
