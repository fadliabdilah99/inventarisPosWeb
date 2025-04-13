<div>
    <div class="">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard </h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                    <a href="#" class="btn btn-primary btn-round">Add Customer</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Member</p>
                                        <h4 class="card-title">{{ $member }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Valuasi Barang</p>
                                        <h4 class="card-title">Rp {{ number_format($valuasi) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-luggage-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Pemasukan</p>
                                        <h4 class="card-title">Rp {{ number_format($pemasukan) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="far fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Pengeluaran</p>
                                        <h4 class="card-title">Rp {{ number_format($pengeluaran) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">User Statistics</div>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                        <span class="btn-label">
                                            <i class="fa fa-pencil"></i>
                                        </span>
                                        Export
                                    </a>
                                    <a href="#" class="btn btn-label-info btn-round btn-sm">
                                        <span class="btn-label">
                                            <i class="fa fa-print"></i>
                                        </span>
                                        Print
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 375px">
                                <canvas id="statisticsChart"></canvas>
                            </div>
                            <div id="myChartLegend"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Daily Sales</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-label-light dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Export
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-category">March 25 - April 02</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1>Rp {{number_format($pemasukanBulan)}}</h1>
                            </div>
                            <div class="pull-in">
                                <canvas id="dailySalesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-body">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">New Customers</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-list py-4">
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="assets/img/jm_denis.jpg" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Jimmy Denis</div>
                                        <div class="status">Graphic Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <span class="avatar-title rounded-circle border border-white">CF</span>
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Chandra Felix</div>
                                        <div class="status">Sales Promotion</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="assets/img/talha.jpg" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Talha</div>
                                        <div class="status">Front End Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="assets/img/chadengle.jpg" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Chad</div>
                                        <div class="status">CEO Zeleaf</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <span
                                            class="avatar-title rounded-circle border border-white bg-primary">H</span>
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Hizrian</div>
                                        <div class="status">Web Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <span
                                            class="avatar-title rounded-circle border border-white bg-secondary">F</span>
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username">Farrah</div>
                                        <div class="status">Marketing</div>
                                    </div>
                                    <button class="btn btn-icon btn-link op-8 me-1">
                                        <i class="far fa-envelope"></i>
                                    </button>
                                    <button class="btn btn-icon btn-link btn-danger op-8">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Transaction History</div>
                                <div class="card-tools">
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-clean me-0" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Payment Number</th>
                                            <th scope="col" class="text-end">Date & Time</th>
                                            <th scope="col" class="text-end">Amount</th>
                                            <th scope="col" class="text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksis as $transaksi)
                                            <tr>
                                                <th scope="row">
                                                    <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    Payment from # {{ $transaksi->id }}
                                                </th>
                                                <td class="text-end">{{ $transaksi->created_at->format('Y-m-d') }}</td>
                                                <td class="text-end">{{ $transaksi->total }}</td>
                                                <td class="text-end">
                                                    <span class="badge badge-success">{{ $transaksi->status }}</span>
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
</div>

@push('scripts')
    <script>
        var dailySalesChart = document.getElementById('dailySalesChart').getContext('2d');
        var salesData = {!! $penjualan !!};
        var labels = {!! $labels !!};

        var myDailySalesChart = new Chart(dailySalesChart, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Sales Analytics",
                    fill: !0,
                    backgroundColor: "rgba(255,255,255,0.2)",
                    borderColor: "#fff",
                    borderCapStyle: "butt",
                    borderDash: [],
                    borderDashOffset: 0,
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 1,
                    pointRadius: 1,
                    pointHitRadius: 5,
                    data: salesData
                }]
            },
            options: {
                maintainAspectRatio: !1,
                legend: {
                    display: !1
                },
                animation: {
                    easing: "easeInOutBack"
                },
                scales: {
                    yAxes: [{
                        display: !1,
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: !0,
                            maxTicksLimit: 10,
                            padding: 0
                        },
                        gridLines: {
                            drawTicks: !1,
                            display: !1
                        }
                    }],
                    xAxes: [{
                        display: !1,
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: -20,
                            fontColor: "rgba(255,255,255,0.2)",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('statisticsChart').getContext('2d');
        var salesData = {!! $penjualan !!};
        var totalData = {!! $total_transaksi !!};
        var labels = {!! $labels !!};

        var statisticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Pemasukan",
                    borderColor: '#f3545d',
                    pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
                    pointRadius: 3,
                    borderWidth: 3, // Membuat garis lebih tebal
                    backgroundColor: 'rgba(243, 84, 93, 0.2)',
                    legendColor: '#f3545d',
                    fill: true,
                    yAxisID: 'y-axis-1', // Pakai sumbu Y pertama
                    data: salesData
                }, {
                    label: "Total Transaksi",
                    borderColor: '#fdaf4b',
                    pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
                    pointRadius: 3,
                    borderWidth: 2, // Lebih tipis dari yang pertama
                    backgroundColor: 'rgba(253, 175, 75, 0.2)',
                    legendColor: '#fdaf4b',
                    fill: true,
                    yAxisID: 'y-axis-2', // Pakai sumbu Y kedua agar tidak tenggelam
                    data: totalData
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    mode: "index",
                    intersect: false
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 15,
                        bottom: 15
                    }
                },
                scales: {
                    yAxes: [{
                        id: 'y-axis-1',
                        position: 'left',
                        ticks: {
                            beginAtZero: false,
                            suggestedMin: Math.min(...salesData) * 0.8, // Agar tidak terlalu rapat di bawah
                            suggestedMax: Math.max(...salesData) * 1.2
                        },
                        gridLines: {
                            drawTicks: false,
                            display: true
                        }
                    }, {
                        id: 'y-axis-2',
                        position: 'right',
                        ticks: {
                            beginAtZero: false,
                            suggestedMin: Math.min(...totalData) * 0.8,
                            suggestedMax: Math.max(...totalData) * 1.2
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 10,
                            fontStyle: "500"
                        }
                    }]
                }
            }
        });
    </script>


    {{-- <script>
        var ctx = document.getElementById('statisticsChart').getContext('2d');

        var salesData = {!! $penjualan !!};
        var totalData = {!! $total_transaksi !!};
        var labels = {!! $labels !!};

        var statisticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Pemasukan",
                    borderColor: '#f3545d',
                    pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(243, 84, 93, 0.4)',
                    legendColor: '#f3545d',
                    fill: true,
                    data: salesData
                }, {
                    label: "Total Transaksi",
                    borderColor: '#fdaf4b',
                    pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
                    pointRadius: 0,
                    backgroundColor: 'rgba(253, 175, 75, 0.4)',
                    legendColor: '#fdaf4b',
                    fill: true,
                    data: totalData
                }, ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 15,
                        bottom: 15
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontStyle: "500",
                            beginAtZero: false,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 10,
                            fontStyle: "500"
                        }
                    }]
                },
                legendCallback: function(chart) {
                    var text = [];
                    text.push('<ul class="' + chart.id + '-legend html-legend">');
                    for (var i = 0; i < chart.data.datasets.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor +
                            '"></span>');
                        if (chart.data.datasets[i].label) {
                            text.push(chart.data.datasets[i].label);
                        }
                        text.push('</li>');
                    }
                    text.push('</ul>');
                    return text.join('');
                }
            }
        });
    </script> --}}
@endpush
