<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function index()
    {
        $data = Transaksi::with('pelanggan', 'produk')->get();
        // dd($data);
        return view('admin.transaksi.index', compact('data'));
    }


    public function getHarga(Request $request)
    {
        $id = $request->produk_id;
        $produk = Produk::find($id);
        // dd($produk);

        return response()->json(['harga' => $produk->harga]);
    }

    public function updateStatus(Transaksi $transaksi)
    {
        $transaksi->status = $transaksi->status == 'belum_lunas' ? 'lunas' : 'belum_lunas';
        $transaksi->save();

        return redirect()->back()->with('success', 'Status pembayaran transaksi berhasil diperbarui.');
    }


    public function create()
    {
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();

        return view('admin.transaksi.create', compact('produk', 'pelanggan'));
    }


    public function store(Request $request)
    {

        Transaksi::create($request->all());

        return redirect()->route('index.transaksi');
    }


    public function edit(string $id)
    {
        $data = Transaksi::findorFail($id);
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        
        return view('admin.transaksi.edit', compact('data', 'produk','pelanggan'));
    }

    public function update(Request $request)
    {
        $data = $request-> all();        
        $item = Transaksi::find($request->id);

        $item->update($data);

        return redirect()->route('index.transaksi');
    }


    public function destroy(string $id)
    {
        $data = Transaksi::findorFail($id);
        $data->delete();

        return redirect()->route('index.transaksi');

    }
}
