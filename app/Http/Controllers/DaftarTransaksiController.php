<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DaftarTransaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class DaftarTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $cart = Cart::where('user_id',auth()->user()->id)->get();
        $hasil = DaftarTransaksi::create([
            'user_id' => auth()->user()->id,
            'total_harga' => $request->total_harga,
            'alamat_pembeli' => $request->alamat_pembeli,
            'status' => 'belum lunas',
            'nohp' => $request->nohp,
        ]);
        foreach( $cart as $c ){
            DetailTransaksi::create([
                'daftar_transaksi_id' => $hasil->id,
                'nama_produk' => $c->product->nama,
                'harga' => $c->product->harga,
                'qty' => $c->qty,
            ]);
        }
        
        return view('cart.payment',compact('hasil'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarTransaksi  $daftarTransaksi
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarTransaksi $daftarTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarTransaksi  $daftarTransaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarTransaksi $daftarTransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarTransaksi  $daftarTransaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaftarTransaksi $daftarTransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarTransaksi  $daftarTransaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarTransaksi $daftarTransaksi,$id)
    {
        //
        $daftartransaksi = DaftarTransaksi::find($id);
        $daftartransaksi->detailtransaksi()->delete();
        $daftartransaksi->delete();

        return redirect('/cart')->with('success','pembayaran dibatalkan');
    }
}
