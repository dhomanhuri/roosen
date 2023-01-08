<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function productIndex(){

        $product = Product::paginate(12);
        return view('product',compact('product'));
    }


    public function index()
    {
        //
        $product = Product::where('user_id',auth()->user()->id)->paginate(10);
        return view('product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create');
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
        $request->validate([
            'nama' => 'required|max:255',
            'harga' => 'required',
            'stok' => 'required|integer',
            'keterangan' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        Product::create([
            'user_id' => auth()->user()->id,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'gambar' => $request->file('gambar')->store('productfoto')
        ]);

        return redirect('/product')->with('success','berhasil menambahkan product');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view('product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|string',
            'stok' => 'required|integer',
            'keterangan' => 'required',
            'gambar' => empty($request->file('gambar')) ? '' : 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ( !empty($request->file('gambar')) ){
            Storage::delete($product->gambar);
        }

        $product->update([
            'nama' => $request->nama,
            'harga' => $request->harga,   
            'stok' => $request->stok,   
            'keterangan' => $request->keterangan,   
            'gambar' => empty($request->file('gambar')) ? $product->gambar : $request->file('gambar')->store('productfoto'),   
        ]);

        return redirect('/product')->with('success','berhasil edit product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        Storage::delete($product->gambar);
        $product->delete();

        return redirect('/product')->with('success','berhasil menghapus product');
    }
}
