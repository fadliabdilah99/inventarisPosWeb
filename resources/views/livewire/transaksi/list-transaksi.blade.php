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
                <a href="{{ route('list-transaksi') }}" wire:navigate>list</a>
            </li>
        </ul>
    </div>
    {{ $id }}
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Top Products</div>
                </div>
                <div class="card-body pb-0">
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ms-2">
                            <h6 class="fw-bold mb-1">CSS</h6>
                            <small class="text-muted">Cascading Style Sheets</small>
                        </div>
                        <div class="d-flex ms-auto align-items-center">
                            <h4 class="text-info fw-bold">+$17</h4>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ms-2">
                            <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                            <small class="text-muted">The Best Donuts</small>
                        </div>
                        <div class="d-flex ms-auto align-items-center">
                            <h4 class="text-info fw-bold">+$300</h4>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="d-flex">
                        <div class="avatar">
                            <img src="assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="flex-1 pt-1 ms-2">
                            <h6 class="fw-bold mb-1">Ready Pro</h6>
                            <small class="text-muted">Bootstrap 5 Admin Dashboard</small>
                        </div>
                        <div class="d-flex ms-auto align-items-center">
                            <h4 class="text-info fw-bold">+$350</h4>
                        </div>
                    </div>
                    <div class="separator-dashed"></div>
                    <div class="pull-in">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Penjualan</h4>
                        <button class="btn btn-primary btn-round ms-auto" wire:click="create">
                            <i class="fa fa-plus"></i>
                            Tambah Penjualan
                        </button>
                    </div>
                </div>
                <div class="card-body">
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
                                @foreach ($list_transaksi as $list)
                                    <tr>
                                        <td>{{ $list->user_id }}</td>
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
