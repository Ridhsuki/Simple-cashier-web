<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Penjualan';
        $subtitle = 'Index';
        $penjualans = Penjualan::join('users', 'penjualans.UsersId', '=', 'users.id')
            ->select('penjualans.*', 'users.name')->get();
        return view('admin.penjualan.index', compact('penjualans', 'title', 'subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Penjualan';
        $subtitle = 'Create';
        $produks = Produk::where('Stok', '>', 0)->get();
        return view('admin.penjualan.create', compact('title', 'subtitle', 'produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'ProdukId' => 'required',
            'JumlahProduk' => 'required',
        ]);
        $data_penjualan = [
            'TanggalPenjualan' => date('Y-m-d'),
            'UsersId' => Auth::user()->id,
            'TotalHarga' => $request->total,
        ];
        $simpanPenjualan = Penjualan::create($data_penjualan);
        foreach ($request->ProdukId as $key => $ProdukId) {
            $simpanDetailPenjualan = DetailPenjualan::create([
                'PenjualanId' => $simpanPenjualan->id,
                'ProdukId' => $ProdukId,
                'harga' => $request->harga[$key],
                'JumlahProduk' => $request->JumlahProduk[$key],
                'SubTotal' => $request->TotalHarga[$key],
            ]);
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan Berhasil Ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }
}
