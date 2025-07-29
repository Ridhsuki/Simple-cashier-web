<?php

namespace App\Http\Controllers;

use App\Models\LogStok;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Milon\Barcode\Facades\DNS1DFacade;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Produk';
        $subtitle = 'Index';
        $search = $request->input('search');
        $products = Produk::query();
        if ($search) {
            $products->where('Nama', 'LIKE', '%' . $search . '%')
                ->orWhere('Harga', 'LIKE', '%' . $search . '%');
        }

        $products = $products->latest()->get();

        return view('admin.produk.index', compact('title', 'subtitle', 'products'));
    }
    public function create()
    {
        $title = 'Produk';
        $subtitle = 'create';
        return view('admin.produk.create', compact('title', 'subtitle'));
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'Nama' => 'required',
            'Harga' => 'required|numeric',
            'Stok' => 'required|numeric',

        ]);
        $validate['Users_id'] = Auth::user()->id;
        $simpan = Produk::create($validate);
        if ($simpan) {
            return response()->json(['status' => 200, 'message' => 'Produk Berhasil Ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'message' => 'Produk Gagal']);
        }
    }
    public function show(Produk $produk)
    {
        //
    }
    public function edit($id)
    {
        $title = 'Produk';
        $subtitle = 'Edit';
        $produk = Produk::find($id);

        return view('admin.produk.edit', compact('title', 'subtitle', 'produk'));
    }
    public function update(Request $request, Produk $produk)
    {
        $validate = $request->validate([
            'Nama' => 'required',
            'Harga' => 'required|numeric',
            'Stok' => 'required|numeric',
        ]);
        $validate['Users_id'] = Auth::user()->id;
        $simpan = $produk->update($validate);
        if ($simpan) {
            return response()->json(['status' => 200, 'message' => 'Produk Berhasil Diubah']);
        } else {
            return response()->json(['status' => 500, 'message' => 'Produk Gagal']);
        }
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan.');
        }

        try {
            $delete = $produk->delete();

            if ($delete) {
                return redirect(route('produk.index'))->with('success', 'Produk berhasil dihapus.');
            } else {
                return redirect(route('produk.index'))->with('error', 'Produk gagal dihapus.');
            }
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('produk.index')->with('error', 'Produk tidak dapat dihapus karena masih tercatat dalam transaksi penjualan. Silakan periksa detail penjualan terkait.');
            }
            return redirect()->route('produk.index')->with('error', 'Terjadi kesalahan database yang tidak terduga: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('produk.index')->with('error', 'Terjadi kesalahan tak terduga: ' . $e->getMessage());
        }
    }
    public function tambahStok(Request $request, $id)
    {
        $validate = $request->validate([
            'Stok' => 'required|numeric',
        ]);
        $produk = Produk::find($id);
        $produk->Stok += $validate['Stok'];
        $update = $produk->save();
        if ($update) {
            return response()->json(['status' => 200, 'message' => 'Stok Berhasil Ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'message' => 'Stok Gagal Ditambahkan']);
        }
    }
    public function logproduk()
    {
        $title = 'Produk';
        $subtitle = 'Log Produk';
        $produks = LogStok::join('produks', 'log_stoks.ProdukId', '=', 'produks.id')
            ->join('users', 'log_stoks.UsersId', '=', 'users.id')
            ->select('log_stoks.JumlahProduk', 'log_stoks.created_at', 'produks.Nama', 'users.name')->get();
        return view('admin.produk.logproduk', compact('title', 'subtitle', 'produks'));
    }
    public function cetaklabel(Request $request)
    {
        $id_produk = $request->id_produk;
        $barcodes = [];

        if (is_array($id_produk)) {
            foreach ($id_produk as $id) {
                $id = (string) $id;
                $produk = Produk::find($id);
                $harga = $produk->Harga;
                $nama_produk = $produk->Nama;
                $barcode = DNS1DFacade::getBarcodeHTML($id, 'C128');
                $barcodes[] = ['barcode' => $barcode, 'harga' => $harga, 'nama_produk' => $nama_produk];
            }
        } else {
            $id_produk = (string) $id_produk;
            $produk = Produk::find($id_produk);
            $harga = $produk->Harga;
            $nama_produk = $produk->Nama;
            $barcode = DNS1DFacade::getBarcodeHTML($id_produk, 'C128');
            $barcodes[] = ['barcode' => $barcode, 'harga' => $harga, 'nama_produk' => $nama_produk];
        }
        $pdf = Pdf::loadView('admin.produk.cetaklabel', compact('barcodes'));

        $file_path = storage_path('app/public/barcodes.pdf');
        $pdf->save($file_path);

        return response()->json(['url' => asset('storage/barcodes.pdf')]);
    }
}