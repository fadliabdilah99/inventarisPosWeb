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
                <a href="{{ route('pengajuan') }}" wire:navigate>Pengajuan Barang</a>
            </li>
        </ul>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Pengajuan Barang</h4>
                    <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                        data-bs-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Ajukan Barang
                    </button>
                    <div class="ps-1">
                        <button wire:click="exportPdf" class="btn btn-link btn-danger"><i class="fas fa-file-pdf fs-2"></i></button>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <!-- Modal -->
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">Ajukan Barang</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">
                                    Tambahkan pengajuan barang disini
                                </p>
                                <form wire:submit.prevent="store">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Nama Barang</label>
                                                <input id="addName" type="text" class="form-control" placeholder=""
                                                    wire:model="nama_barang">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>QTY</label>
                                                <input id="addName" type="text" class="form-control"
                                                    placeholder="000" wire:model="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" id="addRowButton" class="btn btn-primary">
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
                                <th>Pengaju</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Pengajuan</th>
                                <th>QTY</th>
                                <th>Terpenuhi?</th>
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Pengaju</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Pengajuan</th>
                                <th>QTY</th>
                                <th>Terpenuhi?</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($pengajuans as $pengajuan)
                                <tr>
                                    <td>{{ $pengajuan->user->name }}</td>
                                    <td>{{ $pengajuan->nama_barang }}</td>
                                    <td>{{ $pengajuan->tgl_pengajuan }}</td>
                                    <td>{{ $pengajuan->qty }}</td>
                                    <td>
                                        <div class="form-switch">
                                            @if (Auth::user()->role == 'gudang')
                                                <input type="checkbox" class="form-check-input"
                                                    id="customSwitch{{ $pengajuan->id }}"
                                                    {{ $pengajuan->status == 1 ? 'checked' : '' }}
                                                    wire:change="updateTerpenuhi({{ $pengajuan->id }})">
                                                <label class="form-check-label" for="customSwitch{{ $pengajuan->id }}">
                                                    {{-- <span class="switch-text-left">Belum</span>
                                                <span class="switch-text-right">Terpenuhi</span> --}}
                                                </label>
                                            @else
                                                @if ($pengajuan->status == 1)
                                                    <span class="text-success">Terpenuhi <i class="fas fa-check-circle">
                                                        </i></span>
                                                @else
                                                    <span class="text-danger">Menunggu <i
                                                            class="fas fa-clock"></i></span>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-toggle="tooltip" id="alert_demo_7"
                                                title="" class="btn btn-link btn-danger"
                                                data-original-title="Remove" data-id="{{ $pengajuan->id }}">
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

@push('scripts')
    // <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        $("#add-row").DataTable({
            pageLength: 5,
        });

        var action =
            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function() {
            console.log('test');
            // $("#add-row")
            //     .dataTable()
            //     .fnAddData([
            //         $("#addName").val(),
            //         action,
            //     ]);
            @this.call('store');
            $("#addRowModal").modal("hide");
        });
    </script>

    <script>
        $("#alert_demo_7").click(function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                buttons: {
                    confirm: {
                        text: "Yes, delete it!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((Delete) => {
                if (Delete) {
                    swal({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                    @this.call('destroy', $(this).data('id'));
                } else {
                    swal.close();
                }
            });
        });
    </script>
@endpush
