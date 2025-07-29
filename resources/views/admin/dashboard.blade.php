@extends('admin.template.master')

@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Sale</p>
                        <h6 class="mb-0">{{ $todaySalesCount }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Sale</p>
                        <h6 class="mb-0">{{ $totalSalesCount }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Today Revenue</p>
                        <h6 class="mb-0">Rp{{ number_format($todayRevenue, 0, ',', '.') }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Revenue</p>
                        <h6 class="mb-0">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->


    <!-- Sales Chart Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Worldwide Sales</h6>
                    </div>
                    <canvas id="worldwide-sales"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Salse & Revenue</h6>
                    </div>
                    <canvas id="salse-revenue"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Sales Chart End -->


    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Sale</h6>
                <a href="{{ url('/penjualan') }}">Show All</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Date</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Cashier</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentSales as $sale)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ \Carbon\Carbon::parse($sale->TanggalPenjualan)->format('d M Y') }}</td>
                                <td>INV-{{ str_pad($sale->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $sale->user->name ?? 'Unknown' }}</td>
                                <td>Rp{{ number_format($sale->TotalHarga, 0, ',', '.') }}</td>
                                <td>
                                    {{ optional($sale->bayar)->StatusBayar ?? 'Belum Bayar' }}
                                </td>
                                <td>
                                    @if (optional($sale->bayar)->StatusBayar === 'Lunas')
                                        <a href="{{ route('penjualan.nota', $sale->id) }}" class="btn btn-success btn-sm"
                                            target="_blank">
                                            Nota
                                        </a>
                                    @else
                                        <div class="dropdown">
                                            <button class="btn btn-warning btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Bayar
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('penjualan.bayarCash', $sale->id) }}">
                                                        Cash
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item disabled text-muted" href="#">
                                                        Transfer/QRIS (Belum Tersedia)
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Calender</h6>
                        <a href="">Show All</a>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const salesLabels = {!! json_encode($chartLabels) !!};
        const salesData = {!! json_encode($chartSalesData) !!};
        const revenueData = {!! json_encode($chartRevenueData) !!};

        new Chart(document.getElementById("worldwide-sales"), {
            type: "bar",
            data: {
                labels: salesLabels,
                datasets: [{
                    label: "Penjualan",
                    data: salesData,
                    backgroundColor: "rgba(54, 162, 235, 0.7)"
                }]
            }
        });

        new Chart(document.getElementById("salse-revenue"), {
            type: "line",
            data: {
                labels: salesLabels,
                datasets: [{
                        label: "Penjualan",
                        data: salesData,
                        borderColor: "rgba(75, 192, 192, 1)",
                        fill: false
                    },
                    {
                        label: "Pendapatan",
                        data: revenueData,
                        borderColor: "rgba(255, 99, 132, 1)",
                        fill: false
                    }
                ]
            }
        });
    </script>
@endsection
