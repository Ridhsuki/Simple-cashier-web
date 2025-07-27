@extends('admin.template.master')

@section('css')
    <link href="{{ asset('') }}lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('') }}lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">



    <!-- Custom Modal Styling -->
    <style>
        /* Custom Modal Styling */
        .custom-modal {
            background: #f8f9fa;
            /* Light gray background */
            border-radius: 15px;
            /* Rounded corners */
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            /* Soft shadow */
        }

        .custom-modal .modal-header {
            border-bottom: 1px solid #ddd;
            background-color: #4e73df;
            /* Bootstrap primary color */
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            padding: 15px;
        }

        .custom-modal .modal-title {
            font-weight: bold;
            font-size: 1.25rem;
            color: white;
        }

        .custom-modal .modal-body {
            padding: 20px;
        }

        .custom-modal .modal-footer {
            border-top: 1px solid #ddd;
            padding: 15px;
        }

        .custom-input {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 1rem;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .custom-input:focus {
            border-color: #4e73df;
            /* Focus color to match the modal */
            box-shadow: 0 0 8px rgba(0, 116, 255, 0.5);
        }

        .btn-submit {
            background-color: #4e73df;
            border-color: #4e73df;
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: bold;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="modalTambahStok" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content custom-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-tambah-stok" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_produk" id="id_produk">
                        <label for="nilaiTambahStok" class="form-label">Jumlah Stok</label>
                        <input type="number" name="Stok" id="nilaiTambahStok" class="form-control custom-input"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">{{ $title }}</li>
            </ol>
        </nav>
        <div class="row bg-light rounded mx-0">
            <div class="col-12">
                <button type="button" class="btn btn-primary mt-3" id="btnCetakLabel">Cetak Label</button>
                <div class="bg-light rounded p-4">
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

                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
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
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" name="id_produk[]" type="checkbox"
                                                value="{{ $product->id }}" id="id_produk_label">
                                        </div>
                                    </td>
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
    <script>
        $(document).ready(function() {
            // Menangani klik pada tombol tambah stok
            $(document).on('click', '#btnTambahStok', function() {
                let id_produk = $(this).data('id_product'); // Ambil ID produk dari data atribut
                $('#id_produk').val(id_produk); // Set nilai id_produk ke input hidden
                $('#modalTambahStok').modal('show'); // Tampilkan modal
            });

            // Menambahkan auto-focus saat modal muncul
            $('#modalTambahStok').on('shown.bs.modal', function() {
                $('#nilaiTambahStok').trigger('focus'); // Fokus pada input dengan id nilaiTambahStok
            });

            // Menangani form submit untuk tambah stok
            $('#form-tambah-stok').submit(function(e) {
                e.preventDefault(); // Mencegah form submit standar
                var dataForm = $(this).serialize() +
                    "&_token={{ csrf_token() }}"; // Menambahkan CSRF token

                // Kirimkan data ke server menggunakan AJAX
                $.ajax({
                    type: "PUT",
                    url: "{{ route('produk.tambahStok', ':id') }}".replace(':id', $('#id_produk')
                        .val()), // Ganti ID produk
                    data: dataForm,
                    dataType: "json",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "{{ route('produk.index') }}"; // Redirect setelah sukses
                            }
                        })
                        $('#modalTambahStok').modal('hide'); // Menutup modal setelah sukses
                        $('#form-tambah-stok')[0].reset(); // Mereset form
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.responseJSON.message, // Menampilkan pesan error
                            confirmButtonText: 'Ok'
                        })
                    }
                })
            });
        });
    </script>
    <script>
        $(document).on('click', '#btnCetakLabel', function() {
            let id_produk = [];
            $('input[name="id_produk[]"]:checked').each(function() {
                id_produk.push($(this).val());
            });
            $.ajax({
                type: "POST",
                url: "{{ route('produk.cetakLabel') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id_produk: id_produk
                },
                dataType: "json",
                success: function(data) {
                    window.open(data.url, '_blank');
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Harap Checklist Produk untuk melanjutkan mencetak label',
                        confirmButtonText: 'Ok'
                    })
                }
            })
        })
    </script>
@endsection
