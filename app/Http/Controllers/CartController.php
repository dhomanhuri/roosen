<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Courier;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        //
        $cartAll = Cart::where('user_id',auth()->user()->id)->get();
        $cart = Cart::where('user_id',auth()->user()->id)->paginate(5);
        $user = User::where('role','petani')->paginate(12);

        $courier = Courier::pluck('title','code');
        $provinces = Province::pluck('title','province_id');

        $totalBiaya = 0;

        for ( $i = 0; $i < count($cartAll); $i++){
            $totalBiaya += $cartAll[$i]->product->harga * $cartAll[$i]->qty;
        }



        return view('cart.all',compact('cart','user','totalBiaya','courier','provinces'));
    }
    public function checkout($nama){
        $cart = Cart::where('user_id',auth()->user()->id)->where('nama_petani',$nama)->get();
        if( $cart->count() == 0 ){
            Alert::error('Error', 'Cart anda untuk petani ' . $nama . ' Kosong');
            return redirect('/cart')->with('success','Pembyaran sedang error coba lagi nanti');
        }


        $cartAll = Cart::where('user_id',auth()->user()->id)->get();
        $cart = Cart::where('user_id',auth()->user()->id)->paginate(5);
        $user = User::where('role','petani')->paginate(12);

        $courier = Courier::pluck('title','code');
        $provinces = Province::pluck('title','province_id');

        $totalBiaya = 0;

        for ( $i = 0; $i < count($cartAll); $i++){
            $totalBiaya += $cartAll[$i]->product->harga * $cartAll[$i]->qty;
        }



        return view('cart.checkout',compact('cart','user','totalBiaya','courier','provinces','cartAll','nama'));
    }

    public function cartPetani($nama){
        $cartAll = Cart::where('user_id',auth()->user()->id)->get();
        $cart = Cart::where('user_id',auth()->user()->id)->where('nama_petani',$nama)->paginate(12);
        $totalBiaya = 0;

        for ( $i = 0; $i < count($cartAll); $i++){
            $totalBiaya += $cartAll[$i]->product->harga * $cartAll[$i]->qty;
        }

        $courier = Courier::pluck('title','code');
        $provinces = Province::pluck('title','province_id');

        return view('cart.index',compact('cart','totalBiaya','cartAll','courier','provinces','nama'));
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
        


        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $request->product,
            'nama_petani' => $request->nama_petani,
            'qty' => $request->qty,
        ]);
        
        Alert::success('Success', 'Produk Ditambahkan ke keranjang');

        return redirect("product/$request->product#product")->with('success', 'product ditambahkan ke keranjang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //

        if( $cart->user_id !== auth()->user()->id ){
            return redirect('/cart');
        }

        $cartEdit = $cart;
        $cartAll = Cart::where('nama_petani',$cart->nama_petani)->paginate(12);
        $cart = Cart::where('nama_petani',$cart->nama_petani)->paginate(12);
        $totalBiaya = 0;
        $courier = Courier::pluck('title','code');
        $provinces = Province::pluck('title','province_id');
        $nama = $cartEdit->nama_petani;


        for ( $i = 0; $i < count($cartAll); $i++){
            $totalBiaya += $cartAll[$i]->product->harga * $cartAll[$i]->qty;
        }

        return view('cart.solo',compact('cartEdit','cart','totalBiaya','courier','provinces','nama'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
        $request->validate([
            'qty' => 'required'
        ]);



        if ( $request->qty > $cart->product->stok ){
            return redirect(url()->previous())->with('error', 'stok tidak cukup');
        }

        $cart->update([
            'user_id' => $cart->user_id,
            'product_id' => $cart->product_id,
            'qty' => $request->qty,
        ]);

        return redirect(url()->previous())->with('success', 'cart updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$productid)
    {
        //
        $cart = Cart::where('product_id',$productid)->first();
        $cart->delete();

        if( str_contains(url()->previous(),'cart/petani/') ){
            if( Cart::where('nama_petani',$request->nama_petani)->get() === NULL ){
                Alert::success('Success', 'Produk dihapus dari keranjang');
                return redirect("/cart");
            }
            Alert::success('Success', 'Produk dihapus dari keranjang');
            return redirect(url()->previous());
        } else if ( str_contains(url()->previous(),'/product/all') ){
            Alert::success('Success', 'Produk dihapus dari keranjang');
            return redirect("/product/all");
        }
        
        Alert::success('Success', 'Produk dihapus dari keranjang');
        return redirect("product/$productid");
    }
}
