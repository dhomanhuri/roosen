<?php

namespace App\Http\Controllers;

use App\Models\HasilProduksi;
use Illuminate\Http\Request;

class HasilProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hasilproduksi = HasilProduksi::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.hasilproduksi',compact('hasilproduksi'));
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
        $request->validate([
            'tanggal_panen' => 'required',
            'jumlah_pohon' => 'required',
            'jumlah_bunga' => 'required',
            'ukuran_kelopak' => 'required',
        ]);


        HasilProduksi::create([
            'user_id' => auth()->user()->id,
            'tanggal_panen' => $request->tanggal_panen,
            'jumlah_pohon' => $request->jumlah_pohon,
            'jumlah_bunga' => $request->jumlah_bunga,
            'ukuran_kelopak' => $request->ukuran_kelopak,
        ]);

        return redirect('/hasilproduksi')->with('success','berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function show(HasilProduksi $hasilProduksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function edit(HasilProduksi $hasilProduksi,$id)
    {
        //
        $hasilProduksiEdit = HasilProduksi::findOrFail($id);
        if ( $hasilProduksiEdit->user_id !== auth()->user()->id ){
            return redirect('/hasilproduksi');
        }
        $hasilproduksi = HasilProduksi::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.hasilproduksi',compact('hasilProduksiEdit','hasilproduksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilProduksi $hasilProduksi,$id)
    {
        //
        $request->validate([
            'tanggal_panen' => 'required',
            'jumlah_pohon' => 'required',
            'jumlah_bunga' => 'required',
            'ukuran_kelopak' => 'required',
        ]);

        $hasilproduksi = HasilProduksi::findOrFail($id);

        $hasilproduksi->update([
            'user_id' => auth()->user()->id,
            'tanggal_panen' => $request->tanggal_panen,
            'jumlah_pohon' => $request->jumlah_pohon,
            'jumlah_bunga' => $request->jumlah_bunga,
            'ukuran_kelopak' => $request->ukuran_kelopak,
        ]);

        return redirect('/hasilproduksi')->with('success','berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HasilProduksi  $hasilProduksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilProduksi $hasilProduksi,$id)
    {
        //
        $hasilproduksi = HasilProduksi::findOrFail($id);
        $hasilproduksi->delete();
        return redirect('/hasilproduksi')->with('success','berhasil menghapus data');
    }
}
