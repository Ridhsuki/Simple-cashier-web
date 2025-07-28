<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Simple Cashier App by SUKI">
    <meta name="author" content="Ridhsuki">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Cetak Label</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .table-bordered {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .barcode-cell {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            vertical-align: middle;
        }

        .barcode img {
            max-width: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center my-4">Daftar Label Produk</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Barcode</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barcodes as $item)
                    <tr>
                        <td class="barcode-cell">
                            {{ $item['nama_produk'] }}
                        </td>
                        <td class="barcode-cell">
                            {!! $item['barcode'] !!}
                        </td>
                        <td class="barcode-cell">
                            {{ $item['harga'] }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
