<div>
    <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0, 0, 0, 0.5); padding: 1rem; border-radius: 0.5rem;"
        wire:loading>
        <i class="fa fa-spinner fa-spin ms-3" style="color: white;"></i>
        <span style="color: white;">Loading...</span>
    </div>
    @if ($modal == false)
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
                    <a href="{{ route('absensi') }}" wire:navigate>Absensi</a>
                </li>
            </ul>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Absensi Karyawan</h4>
                        <div class="d-flex">
                            <form wire:submit.prevent="import" class="me-2">
                                <input type="file" wire:model="file" accept=".xlsx, .xls" class="form-control">
                                @error('file')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <button type="submit" class="btn btn-primary btn-sm">Import</button>
                                <button wire:click="export" type="button"
                                    class="btn btn-success btn-sm">Export</button>
                                <button wire:click="format" type="button"
                                    class="btn btn-success btn-sm">Template</button>
                                <a href="{{ route('absensi.exportpdf') }}" target="_blank"
                                    class="btn btn-danger btn-sm">Export PDF</a>
                            </form>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                            data-bs-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Tambah Data
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
                                        <span class="fw-mediumbold">Tambah Karyawan</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="small">
                                        Masukkan data karyawan
                                    </p>
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif
                                    <form wire:submit.prevent="store">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Name</label>
                                                    <input id="addName" type="text" class="form-control"
                                                        placeholder="fill name" wire:model="name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group form-group-default">
                                                    <label>Password</label>
                                                    <input id="addName" type="password" class="form-control"
                                                        placeholder="Password" wire:model="password" />
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

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">

                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Waktu Masuk</th>
                                    <th>Status</th>
                                    <th>Waktu Selesai Kerja</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Waktu Masuk</th>
                                    <th>Status</th>
                                    <th>Waktu Selesai Kerja</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($absensis as $index => $karyawan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $karyawan->name }}</td>
                                        @php
                                            $todayAbsensi = $karyawan
                                                ->absensi()
                                                ->whereDate('created_at', date('Y-m-d'))
                                                ->first();
                                        @endphp
                                        <td>{{ $todayAbsensi ? $todayAbsensi->created_at->format('Y-m-d') : '-' }}</td>
                                        <td>{{ $todayAbsensi->waktu_masuk ?? '-' }}</td>
                                        <td>
                                            @if ($todayAbsensi)
                                                {{ $todayAbsensi->status ?? '-' }}
                                            @else
                                                <select id="addName" class="form-control" placeholder="000"
                                                    wire:change="absensi({{ $karyawan->id }})" wire:model="status">
                                                    <option>Belum Absen</option>
                                                    <option value="masuk">masuk</option>
                                                    <option value="sakit">sakit</option>
                                                    <option value="cuti">cuti</option>
                                                </select>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($todayAbsensi)
                                                @if ($todayAbsensi->waktu_keluar)
                                                    {{ $todayAbsensi->waktu_keluar }}
                                                @else
                                                    <button type="button"
                                                        onclick=" return confirmWaktuKeluar({{ $karyawan->id }})"
                                                        class="btn btn-success ">selesai</button>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <button wire:loading.attr="disabled"
                                                    wire:click="ShowModal({{ $karyawan->id }})" type="button"
                                                    data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task"><i
                                                        class="fa fa-edit"></i></button>
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger"
                                                    onclick="return confirmRemove({{ $karyawan->id }})"
                                                    data-original-title="Remove">
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
    @elseif ($modal == true)
        @include('livewire.absensi.modal')

    @endif
</div>

@push('scripts')
    {{-- //   <!-- Datatables --> --}}
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script>
        console.log('test');
        $("#add-row").DataTable({
            pageLength: 5,
        });

        var action =
            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function() {
            // $("#add-row")
            //     .dataTable()
            //     .fnAddData([
            //         $("#addName").val(),
            //         action,
            //     ]);
            $("#addRowModal").modal("hide");
        });
    </script>
    <script>
        function confirmRemove(id) {
            return swal({
                title: "Apakah kamu yakin?",
                text: "Kamu akan menghapus karyawan ini!",
                type: "warning",
                buttons: {
                    cancel: {
                        visible: true,
                        text: "tidak!",
                        className: "btn btn-danger",
                    },
                    confirm: {
                        text: "Ya, Hapus!",
                        className: "btn btn-success",
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    @this.set('karyawanId', id);
                    @this.call('delete');
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                } else {
                    swal("Your imaginary file is safe!", {
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                }
            });
        }
    </script>

    <script>
        function confirmWaktuKeluar(id) {
            return swal({
                title: "Apakah kamu yakin?",
                text: "Kamu akan melakukan absen keluar!",
                type: "warning",
                buttons: {
                    cancel: {
                        visible: true,
                        text: "tidak!",
                        className: "btn btn-danger",
                    },
                    confirm: {
                        text: "Ya!",
                        className: "btn btn-success",
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    @this.set('karyawanId', id);
                    @this.call('WaktuKeluar');
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                } else {
                    swal("Your imaginary file is safe!", {
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                }
            });
        }
    </script>
@endpush
