@extends('admin.template.master')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">{{ $title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
            </ol>
        </nav>
        <div class="row vh-100 bg-light rounded  mx-0">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4 d-flex justify-content-between align-items-center">
                        {{ $title }}
                        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-warning">Kembali</a>
                    </h6>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Tambah Data</h6>
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div id="error" style="display:none">
                                <div class="alert alert-danger">
                                    <p id="error-message"></p>
                                </div>
                            </div>
                            <form id='form-create-produk' method="POST">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Produk</label>
                                    <input type="text" name="Nama" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Harga (Rp)</label>
                                    <input type="number" name="Harga" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Stok</label>
                                    <input type="number" name="Stok" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#form-create-produk").submit(function(e) {
                e.preventDefault();
                dataForm = $(this).serialize() + "&_token={{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    url: "{{ route('produk.store') }}",
                    data: dataForm,
                    dataType: "json",
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message +
                                ' Apa yang ingin Anda lakukan selanjutnya?',
                            showCancelButton: true,
                            confirmButtonText: 'Tambah Produk Lagi', 
                            cancelButtonText: 'Kembali ke Daftar Produk'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('input[name="Nama"]').val('');
                                $('input[name="Harga"]').val('');
                                $('input[name="Stok"]').val('');
                                $('input[name="Nama"]').focus();
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                window.location.href = "{{ route('produk.index') }}";
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error:", textStatus, errorThrown);
                        console.error("Response Text:", jqXHR.responseText);
                        let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';

                        if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                            errorMessage = jqXHR.responseJSON.message;
                        } else if (jqXHR.status === 500) {
                            errorMessage = 'Terjadi kesalahan server internal.';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            });
        });
    </script>
@endsection
