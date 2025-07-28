<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->Leftjoin('bayars', 'penjualans.id', '=', 'bayars.PenjualanId')
            ->select('penjualans.*', 'users.name', 'bayars.StatusBayar')
            ->with(['detailPenjualan.produk'])
            ->get();
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
        $validate = $request->validate([
            'ProdukId' => 'required',
            'JumlahProduk' => 'required',
            'ProdukId.*' => 'exists:produks,id',
            'JumlahProduk.*' => 'numeric|min:1'
        ]);

        DB::beginTransaction();

        try {
            // Data penjualan yang akan disimpan
            $data_penjualan = [
                'TanggalPenjualan' => now(),
                'UsersId' => Auth::user()->id,
                'TotalHarga' => $request->total,
            ];

            $simpanPenjualan = Penjualan::create($data_penjualan);

            foreach ($request->ProdukId as $key => $ProdukId) {
                $product = Produk::find($ProdukId);
                $quantitySold = $request->JumlahProduk[$key];

                if ($product->Stok < $quantitySold) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Stok tidak mencukupi untuk produk: ' . $product->Nama);
                }

                $product->Stok -= $quantitySold;
                $product->save();

                DetailPenjualan::create([
                    'PenjualanId' => $simpanPenjualan->id,
                    'ProdukId' => $ProdukId,
                    'harga' => $request->harga[$key],
                    'JumlahProduk' => $quantitySold,
                    'SubTotal' => $request->TotalHarga[$key],
                ]);
            }

            DB::commit();

            return redirect()->route('penjualan.index')->with('success', 'Penjualan Berhasil Ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
        // $data_penjualan = [
        //     'TanggalPenjualan' => date('Y-m-d'),
        //     'UsersId' => Auth::user()->id,
        //     'TotalHarga' => $request->total,
        // ];
        // $simpanPenjualan = Penjualan::create($data_penjualan);
        // foreach ($request->ProdukId as $key => $ProdukId) {
        //     $simpanDetailPenjualan = DetailPenjualan::create([
        //         'PenjualanId' => $simpanPenjualan->id,
        //         'ProdukId' => $ProdukId,
        //         'harga' => $request->harga[$key],
        //         'JumlahProduk' => $request->JumlahProduk[$key],
        //         'SubTotal' => $request->TotalHarga[$key],
        //     ]);
        // }

        // return redirect()->route('penjualan.index')->with('success', 'Penjualan Berhasil Ditambahkan');
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
    public function bayarCash($id)
    {
        $title = 'Penjualan';
        $subtitle = 'Bayar Cash';
        $penjualan = Penjualan::find($id);
        $detailpenjualan = DetailPenjualan::join('produks', 'detail_penjualans.ProdukId', '=', 'produks.id')
            ->where('PenjualanId', $id)->get();
        return view('admin.penjualan.bayarCash', compact('title', 'subtitle', 'penjualan', 'detailpenjualan'));
    }
    public function bayarCashStore(Request $request)
    {
        $validate = $request->validate([
            'JumlahBayar' => 'required',
        ]);

        $simpan = Bayar::create([
            'PenjualanId' => $request->id,
            'TanggalBayar' => date('Y-m-d H:i:s'),
            'TotalBayar' => $request->JumlahBayar,
            'Kembalian' => $request->Kembalian,
            'StatusBayar' => 'Lunas',
            'JenisBayar' => 'Cash',
        ]);

        if ($simpan) {
            return response()->json(['status' => 200, 'message' => 'Pembayaran Berhasil']);
        } else {
            return response()->json(['status' => 500, 'message' => 'Pembayaran Gagal']);
        }

    }
    public function Nota($id)
    {
        $penjualan = Penjualan::find($id);
        $detailpenjualan = DetailPenjualan::join('produks', 'detail_penjualans.ProdukId', '=', 'produks.id')
            ->where('PenjualanId', $id)->get();
        $bayar = Bayar::where('PenjualanId', $id)->get();
        $totalBayar = 0;
        $kembalian = 0;
        foreach ($bayar as $item) {
            $totalBayar = $item->TotalBayar;
            $kembalian = $item->Kembalian;
        }
        return view('admin.penjualan.nota', compact('penjualan', 'detailpenjualan', 'totalBayar', 'kembalian'));
    }
}
