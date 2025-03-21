<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        $title = 'Produk';
        $subtitle = 'Index';
        $products = Produk::all();
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
    public function edit(Produk $produk)
    {
        //
    }
    public function update(Request $request, Produk $produk)
    {
        //
    }
    public function destroy(Produk $produk)
    {
        //
    }
}
