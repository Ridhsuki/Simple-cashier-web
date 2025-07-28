@extends('admin.template.master')

@section('css')
    <link href="{{ asset('') }}lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('') }}lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ $title }}</li>
            </ol>
        </nav>
        <div class="row bg-light rounded mx-0">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4 d-flex justify-content-between align-items-center">
                        {{ $title }}
                        <a href="{{ route('penjualan.create') }}" class="btn btn-sm btn-primary">Tambah</a>
                    </h6>

                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <table class="table text-start align-middle table-bordered table-hover mb-0 table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal Penjualan</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Penjual</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penjualans as $penjualan)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $penjualan->TanggalPenjualan }}</td>
                                    <td>
                                        @if ($penjualan->detailPenjualan->isNotEmpty())
                                            @foreach ($penjualan->detailPenjualan as $detail)
                                                @if ($detail->produk)
                                                    {{ $detail->produk->Nama }} ({{ $detail->JumlahProduk }}
                                                    unit)<br>
                                                @else
                                                    Produk Tidak Ditemukan (ID: {{ $detail->ProdukId }})<br>
                                                @endif
                                            @endforeach
                                        @else
                                            Tidak ada produk
                                        @endif
                                    </td>
                                    <td>{{ rupiah($penjualan->TotalHarga) }}</td>
                                    <td>{{ $penjualan->name }}</td>
                                    <td>
                                        @if ($penjualan->StatusBayar == 'Lunas')
                                            <a href="{{ route('penjualan.nota', $penjualan->id) }}" class="btn btn-success"
                                                target="_blank">Nota</a>
                                        @else
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Bayar
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('penjualan.bayarCash', $penjualan->id) }}">Cash</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">Transfer/Qris</a></li>
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data penjualan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('') }}lib/chart/chart.min.js"></script>
    <script src="{{ asset('') }}lib/easing/easing.min.js"></script>
    <script src="{{ asset('') }}lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('') }}lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('') }}lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{ asset('') }}lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{ asset('') }}lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
@endsection
