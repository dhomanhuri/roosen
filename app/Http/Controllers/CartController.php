<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Courier;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cartAll = Cart::where('user_id',auth()->user()->id)->get();
        $cart = Cart::where('user_id',auth()->user()->id)->paginate(12);
        $totalBiaya = 0;

        for ( $i = 0; $i < count($cartAll); $i++){
            $totalBiaya += $cartAll[$i]->product->harga * $cartAll[$i]->qty;
        }

        $courier = Courier::pluck('title','code');
        $provinces = Province::pluck('title','province_id');

        return view('cart.index',compact('cart','totalBiaya','cartAll','courier','provinces'));
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
            'product_id' => $request->product_id,
            'qty' => $request->qty,
        ]);
     
        return redirect("product/$request->product_id#product")->with('success', 'product ditambahkan ke keranjang');
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
        $cartAll = Cart::where('user_id',auth()->user()->id)->paginate(12);
        $cart = Cart::where('user_id',auth()->user()->id)->paginate(12);
        $totalBiaya = 0;



        for ( $i = 0; $i < count($cartAll); $i++){
            $totalBiaya += $cartAll[$i]->product->harga * $cartAll[$i]->qty;
        }

        return view('cart.index',compact('cartEdit','cart','totalBiaya'));
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
            return redirect("/cart")->with('error', 'stok tidak cukup');
        }

        $cart->update([
            'user_id' => $cart->user_id,
            'product_id' => $cart->product_id,
            'qty' => $request->qty,
        ]);

        return redirect("/cart")->with('success', 'cart updated');
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

        if( str_contains(url()->previous(),'/cart') ){
            return redirect("/cart")->with('success', 'product dihapus dari keranjang');
        } else if ( str_contains(url()->previous(),'/product/all') ){
            return redirect("/product/all")->with('success', 'product dihapus dari keranjang');
        }
        
        return redirect("product/$productid")->with('success', 'product dihapus dari keranjang');
    }
}
