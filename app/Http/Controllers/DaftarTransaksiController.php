<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\DaftarTransaksi;
use App\Models\DetailTransaksi;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use RealRashid\SweetAlert\Facades\Alert;

class DaftarTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'ispembeli',])->except('index','afterPayment');
    }

    public function index()
    {
        //
        if (auth()->user()->role !== 'petani') {
            return abort(403);
        }

        


        $transaksi = DaftarTransaksi::where('nama_petani',auth()->user()->name)->paginate(10);
        $allTransaksi = DaftarTransaksi::where('nama_petani',auth()->user()->name)->get();
        $invoice = 0;


        foreach( $allTransaksi as $trans ){
            $invoice += $trans->total_harga + $trans->ongkir; 
        }



        return view('transaksi.index', compact('transaksi','invoice'));
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
        $id_pesanan = Carbon::now()->timestamp;

        $cart = Cart::where('user_id',auth()->user()->id)->where('nama_petani',$request->nama_petani)->get();
        if( $cart->count() == 0 ){
            Alert::error('Error', 'Cart anda untuk petani ' . $request->nama_petani . ' Kosong');
            return redirect('/cart')->with('success','Pembyaran sedang error coba lagi nanti');
        }

        try {
            $cost = RajaOngkir::ongkosKirim([
                'origin'        => 305, // ID kota/kabupaten asal
                'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
                'weight'        => '20', // berat barang dalam gram
                'courier'       => 'jne' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();

             // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

          

            $ongkir = $cost[0]['costs'][0]['cost'][0]['value'];

            $hasil = DaftarTransaksi::create([
                'user_id' => auth()->user()->id,
                'nama_petani' => $request->nama_petani,
                'id_pesanan' => $id_pesanan,
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

              $params = array(
                'transaction_details' => array(
                    'order_id' => $id_pesanan,
                    'gross_amount' => $hasil->total_harga + $ongkir,
                ),
                'customer_details' => array(
                    'nama' => $hasil->user->name,
                    'email' => $hasil->user->email,
                    'phone' => $request->nohp,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
    
        } catch (Exception $error){
            Alert::error('Error', 'Pembayaran sedang error. Coba lagi nanti');
            return redirect('/cart')->with('success','Pembyaran sedang error coba lagi nanti');
        }

       
        return view('cart.payment', compact('hasil', 'snapToken'));
    }

    public function afterPayment(Request $request)
    {
        
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $transaksi = DaftarTransaksi::where('id_pesanan',$request->order_id)->first();
                foreach ($transaksi->detailtransaksi as $daftarTransaksi) {
                    $getProduk = Product::where('nama', $daftarTransaksi->nama_produk)->first();
                    $cart = Cart::where('nama_petani',$transaksi->nama_petani)->first();
                    $getProduk->update(['stok' => $getProduk->stok - $daftarTransaksi->qty]);
                    $cart->delete();
                }
                $transaksi->update(['status' => 'lunas']);
            }
        }
    }

    public function riwayatTransaksi()
    {

        $transaksi = DaftarTransaksi::where('user_id', auth()->user()->id)->paginate(12);
        return view('transaksi.riwayat', compact('transaksi'));
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

        if ($daftartransaksi->status == 'lunas') {
            Alert::success('Success', 'Pembayaran anda berhasil, terimakasih');
            return redirect('/cart')->with('success', 'pembayaran anda berhasil, terimakasih');
        }

        $daftartransaksi->detailtransaksi()->delete();
        $daftartransaksi->delete();
        Alert::error('Error', 'Pembayaran dibatalkan');
        return redirect('/cart')->with('success', 'pembayaran dibatalkan');
    }
}
