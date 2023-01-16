<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\DaftarTransaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class DaftarTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','ispembeli'])->except('index');
    }

    public function index()
    {
        //
        $transaksi = DaftarTransaksi::paginate(10);
        return view('transaksi.index',compact('transaksi'));
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
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => '20', // berat barang dalam gram
            'courier'       => 'jne' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        $ongkir = $cost[0]['costs'][0]['cost'][0]['value'];

        $cart = Cart::where('user_id', auth()->user()->id)->get();
        $hasil = DaftarTransaksi::create([
            'user_id' => auth()->user()->id,
            'total_harga' => $request->total_harga,
            'ongkir' => $ongkir,
            'alamat_pembeli' => $request->alamat_pembeli,
            'status' => 'belum lunas',
            'nohp' => $request->nohp,
        ]);
        foreach ($cart as $c) {
            DetailTransaksi::create([
                'daftar_transaksi_id' => $hasil->id,
                'nama_produk' => $c->product->nama,
                'harga' => $c->product->harga,
                'qty' => $c->qty,
            ]);
        }


        //
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $hasil->id,
                'gross_amount' => $hasil->total_harga + $ongkir,
            ),
            'customer_details' => array(
                'nama' => $hasil->user->name,
                'email' => $hasil->user->email,
                'phone' => $request->nohp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        


        return view('cart.payment', compact('hasil','snapToken'));
    }

    public function afterPayment(Request $request){

        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512',$request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if( $hashed == $request->signature_key){
            if( $request->transaction_status == 'capture'){
                $transaksi = DaftarTransaksi::find($request->order_id);
                $transaksi->update(['status' => 'lunas']);
            }
        }
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
    public function destroy(DaftarTransaksi $daftarTransaksi, $id)
    {
        //
        
        $daftartransaksi = DaftarTransaksi::find($id);
        
        if ( $daftartransaksi->status == 'lunas'){
            return redirect('/cart')->with('success','pembayaran anda berhasil, terimakasih');
        }
        
        $daftartransaksi->detailtransaksi()->delete();
        $daftartransaksi->delete();

        return redirect('/cart')->with('success', 'pembayaran dibatalkan');
    }
}
