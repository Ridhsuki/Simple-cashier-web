<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title" content="Simple Cashier App by SUKI">
    <meta name="author" content="Ridhsuki">
    <title>Nota</title>
</head>

<style>
    table,
    td,
    th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>

<body>
    <h1 align="center">Nota Toko RIDHSUKI</h1>
    <h5>Alamat Politeknik IDN Bogor</h5>

    <table width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailpenjualan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->NamaProduk }}</td>
                    <td>{{ rupiah($item->harga) }}</td>
                    <td>{{ $item->JumlahProduk }}</td>
                    <td>{{ rupiah($item->SubTotal) }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4" align="right">Total Harga</td>
                <td> {{ rupiah($penjualan->TotalHarga) }}
                </td>
            </tr>
            <tr>
                <td colspan="4" align="right">Jumlah Bayar</td>
                <td>{{ $totalBayar }}</td>
            </tr>
            <tr>
                <td colspan="4" align="right">Kembalian</td>
                <td>{{ $kembalian }}</td>
            </tr>

            <tr>
                <td colspan="4" align="right">Kasir</td>
                <td>{{ Auth::user()->name }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>

<script>
    window.print();
</script>