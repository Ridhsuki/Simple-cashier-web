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
                <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">{{ $title }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $subtitle }}</li>
            </ol>
        </nav>
        <div class="row vh-100 bg-light rounded  mx-0">
            <div class="col-12">
                <form action="{{ route('penjualan.store') }}" method="post" id="formPenjualan">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4 d-flex justify-content-between align-items-center">
                            {{ $title }}
                            <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-warning">Kembali</a>
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
                        <table class="table table-bordered table-responsive">
                            @csrf
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="penjualan">
                                <tr>
                                    <td>
                                        <select name="ProdukId[]" id="id_produk" class="form-control kode-produk"
                                            onchange="pilihProduk(this)">
                                            <option value="">Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}">
                                                    {{ $produk->Nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="harga[]" id="harga" class="form-control harga"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="JumlahProduk[]" id="JumlahProduk "
                                            class="form-control jumlahProduk" oninput="hitungTotal(this)">
                                    </td>
                                    <td>
                                        <input type="text" name="TotalHarga[]" id="TotalHarga"
                                            class="form-control totalHarga" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger"
                                            onclick="hapusProduk(this)">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="3">
                                        Total harga
                                    </td>
                                    <td colspan="2">Rp
                                        <input type="text" id="total" readonly class="form-control" name="total">
                                    </td>
                            </tfooter>
                        </table>
                        <button type="button" class="btn btn-primary" onclick="tambahProduk()">Tambah Produk</button>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
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
        function tambahProduk() {
            const newArrow = `
            <tr>
                                        <td>
                                            <select name="ProdukId[]" id="id_produk" class="form-control kode-produk" onchange="pilihProduk(this)">
                                                <option value="">Pilih Produk</option>
                                                @foreach ($produks as $produk)
                                                    <option value="{{ $produk->id }}" data-harga="{{ $produk->Harga }}" >{{ $produk->Nama }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </td>
                                        <td>
                                            <input type="text" name="harga[]" id="harga" class="form-control harga" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahProduk[]" id="JumlahProduk" class="form-control jumlahProduk" oninput="hitungTotal(this)">
                                        </td>
                                        <td>
                                            <input type="text" name="TotalHarga[]" id="TotalHarga" class="form-control totalHarga" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="hapusProduk(this)">Hapus</button>
                                        </td>
                                    </tr>
            `;
            $('#penjualan').append(newArrow);
        }

        function hapusProduk(buttonElement) {
            $(buttonElement).closest('tr').remove();
        }

        function pilihProduk(produk) {
            const selectOption = produk.options[produk.selectedIndex];
            const row = $(produk).closest('tr');

            const harga = $(selectOption).data('harga');

            const selectedKode = produk.value;
            if ($(".kode-produk").not(produk).filter((_, el) => el.value === selectedKode).length > 0) {
                alert('Produk sudah ada');
                row.find('.kode-produk').val('');
                return;
            }

            row.find('.harga').val(harga);
        }

        function hitungTotal(inputElement) {
            const row = $(inputElement).closest('tr');
            const harga = parseFloat(row.find('.harga').val());
            const jumlahProduk = parseFloat(inputElement.value);
            const totalHarga = harga * jumlahProduk;
            row.find('.totalHarga').val(totalHarga);

            hitungTotalAkhir();
        }

        function hitungTotalAkhir() {
            let total = 0;

            $('.totalHarga').each(function() {
                total += parseFloat($(this).val()) || 0;
            });

            $('#total').val(total);
        }

        $(document).ready(function() {
            $('#formPenjualan').on('submit', function(e) {
                let isValid = true;
                let errorMessage = '';

                if ($('#penjualan tr').length === 0) {
                    errorMessage = 'Tambahkan setidaknya satu produk untuk melakukan penjualan.';
                    isValid = false;
                } else {
                    $('#penjualan tr').each(function() {
                        const produkId = $(this).find('.kode-produk').val();
                        const jumlahProduk = $(this).find('.jumlahProduk').val();
                        const totalHargaPerItem = $(this).find('.totalHarga').val();

                        if (!produkId || produkId.trim() === '') {
                            errorMessage = 'Pilih produk untuk setiap baris yang ditambahkan.';
                            isValid = false;
                            return false;
                        }

                        if (!jumlahProduk || parseFloat(jumlahProduk) <= 0 || isNaN(parseFloat(
                                jumlahProduk))) {
                            errorMessage =
                                'Jumlah produk harus lebih dari 0 untuk setiap produk yang dipilih.';
                            isValid = false;
                            return false;
                        }

                        if (!totalHargaPerItem || parseFloat(totalHargaPerItem) <= 0 || isNaN(
                                parseFloat(totalHargaPerItem))) {
                            errorMessage =
                                'Total harga untuk setiap produk tidak boleh kosong atau nol. Pastikan produk dan jumlah sudah benar.';
                            isValid = false;
                            return false;
                        }
                    });
                }


                if (!isValid) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validasi Gagal',
                        text: errorMessage,
                        confirmButtonText: 'Oke',
                    });
                }
            });

            hitungTotalAkhir();
        });
    </script>
@endsection
