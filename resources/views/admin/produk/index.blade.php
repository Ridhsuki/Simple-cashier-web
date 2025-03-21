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
                <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
            </ol>
        </nav>
        <div class="row vh-100 bg-light rounded  mx-0">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    {{-- <div class="card"> --}}
                    {{-- <div class="card-header"> --}}
                    <h6 class="mb-4 d-flex justify-content-between align-items-center">
                        {{ $title }}
                        <a href="{{ route('produk.create') }}" class="btn btn-sm btn-primary">Tambah</a>
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

                    {{-- </div> --}}
                    {{-- <div class="card-body"> --}}
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $product->Nama }}</td>
                                    <td>{{ rupiah($product->Harga) }}</td>
                                    <td>{{ $product->Stok }}</td>
                                    <td>
                                        <form id="form-delete-produk" action="{{ route('produk.destroy', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('produk.edit', $product->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            <button type="button" class="btn btn-sm btn-warning" id="btnTambahStok"
                                                data-toggle="modal" data-target="#modalTambahStok"
                                                data-id_product="{{ $product->id }}">
                                                Tambah Stok
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- </div> --}}
                    {{-- </div> --}}
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
    <script>
        $("#form-delete-produk").submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data tidak akan bisa kembali",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data Ini !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).unbind().submit();
                }
            })
        });
    </script>
@endsection
