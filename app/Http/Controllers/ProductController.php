<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
    public function __construct()
    {
        $this->middleware(['auth','ispetani'])->except('productIndex','show','search');
    }

    public function productIndex()
    {

        $product = Product::latest()->paginate(6);
        // $cart = Cart::where('user_id',auth()->user()->id);
        // $cartUser = [];

        // foreach ( $cart as $index=>$crt ){
        //     $cartUser[] = $crt[$index]->product_id;
        // }


        // dd($cartUser);

        return view('product', compact('product'));
    }

    public function searchDashboard(Request $request)
    {
        $product = Product::where('nama', 'like', "%" . $request->keyword . "%")->paginate(10)->withQueryString();
        $productAll = Product::where('nama', 'like', "%" . $request->keyword . "%");

        return view('product.index', compact('product', 'productAll'));
    }



    public function search(Request $request)
    {
        $product = Product::where('nama', 'like', "%" . $request->keyword . "%")->paginate(12)->withQueryString();
        $productAll = Product::where('nama', 'like', "%" . $request->keyword . "%");

        return view('product', compact('product', 'productAll'));
    }

    public function index()
    {
        //
        $product = Product::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('product.index', compact('product'));
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

        return redirect('/product')->with('success', 'berhasil menambahkan product');
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
        $cart = auth()->user() ? Cart::where('product_id',$product->id)->where('user_id',auth()->user()->id)->first() : '' ;
        
        return view('product.show', compact('product','cart'));
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
        return view('product.edit', compact('product'));
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

        if (!empty($request->file('gambar'))) {
            Storage::delete($product->gambar);
        }

        $product->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'gambar' => empty($request->file('gambar')) ? $product->gambar : $request->file('gambar')->store('productfoto'),
        ]);

        return redirect('/product')->with('success', 'berhasil edit product');
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

        return redirect('/product')->with('success', 'berhasil menghapus product');
    }
}
