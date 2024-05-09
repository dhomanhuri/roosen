<?php

namespace App\Http\Controllers;

use App\Models\Penyiraman;
use Illuminate\Http\Request;

class PenyiramanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $penyiraman = Penyiraman::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.penyiraman',compact('penyiraman'));
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
            'tanggal' => 'required',
            'volume' => 'required',
        ]);


        Penyiraman::create([
            'user_id' => auth()->user()->id,
            'tanggal' => $request->tanggal,
            'volume' => $request->volume,
        ]);

        return redirect('/penyiraman')->with('success','berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penyiraman  $penyiraman
     * @return \Illuminate\Http\Response
     */
    public function show(Penyiraman $penyiraman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penyiraman  $penyiraman
     * @return \Illuminate\Http\Response
     */
    public function edit(Penyiraman $penyiraman)
    {
        //
        $penyiramanEdit = $penyiraman;
        if ( $penyiramanEdit->user_id !== auth()->user()->id ){
            return redirect('/penyiraman');
        }
        $penyiraman = Penyiraman::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.penyiraman',compact('penyiramanEdit','penyiraman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penyiraman  $penyiraman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penyiraman $penyiraman)
    {
        //
        $request->validate([
            'tanggal' => 'required',
            'volume' => 'required',
        ]);


        $penyiraman->update([
            'user_id' => auth()->user()->id,
            'tanggal' => $request->tanggal,
            'volume' => $request->volume,
        ]);

        return redirect('/penyiraman')->with('success','berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penyiraman  $penyiraman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penyiraman $penyiraman)
    {
        //
        $penyiraman->delete();
        return redirect('/penyiraman')->with('success','berhasil menghapus data');
    }
}
