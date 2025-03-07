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
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambahkan Produk</div>
                </div>
                <form wire:submit.prevent='store' method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    <label for="kode" class="form-label">Kode Produk</label>
                                    <input type="text" id="kode" wire:model="kode" class="form-control">
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
                                            <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
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
                                    <input type="number" wire:model="margin" class="form-control" placeholder="Rp ...">
                                </div>
                                <div class="form-group">
                                    <label for="email2">discount</label>
                                    <input type="number" wire:model="discount" class="form-control" placeholder="xx%">
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
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">daftar produk</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>stok</th>
                                        <th>margin</th>
                                        <th>disc</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>stok</th>
                                        <th>margin</th>
                                        <th>disc</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($produks as $prod)
                                        <tr>
                                            <td>
                                                {{ $prod->produk }} <br> <span class="text-muted text-ms">{{ $prod->kategori->kategori . " / " . $prod->kode }}</span> </td>
                                            <td>{{ $prod->stok . " " . $prod->satuan }}</td>
                                            <td>{{ $prod->margin }}</td>
                                            <td>{{ $prod->discount }}</td>
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
@endpush
