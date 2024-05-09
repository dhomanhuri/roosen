<?php

namespace App\Http\Controllers;

use App\Models\Pemupukan;
use Illuminate\Http\Request;

class PemupukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pemupukan = Pemupukan::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.pemupukan',compact('pemupukan'));
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
            'tanggal_pemupukan' => 'required',
            'jenis_pupuk' => 'required',
            'volume_pupuk' => 'required',
        ]);


        Pemupukan::create([
            'user_id' => auth()->user()->id,
            'tanggal_pemupukan' => $request->tanggal_pemupukan,
            'jenis_pupuk' => $request->jenis_pupuk,
            'volume_pupuk' => $request->volume_pupuk,
        ]);

        return redirect('/pemupukan')->with('success','berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemupukan  $pemupukan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemupukan $pemupukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemupukan  $pemupukan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemupukan $pemupukan)
    {
        //
        $pemupukanEdit = $pemupukan;
        if ( $pemupukanEdit->user_id !== auth()->user()->id ){
            return redirect('/pemupukan');
        }
        $pemupukan = Pemupukan::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.pemupukan',compact('pemupukanEdit','pemupukan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemupukan  $pemupukan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemupukan $pemupukan)
    {
        //
        $request->validate([
            'tanggal_pemupukan' => 'required',
            'jenis_pupuk' => 'required',
            'volume_pupuk' => 'required',
        ]);


        $pemupukan->update([
            'user_id' => auth()->user()->id,
            'tanggal_pemupukan' => $request->tanggal_pemupukan,
            'jenis_pupuk' => $request->jenis_pupuk,
            'volume_pupuk' => $request->volume_pupuk,
        ]);

        return redirect('/pemupukan')->with('success','berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemupukan  $pemupukan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemupukan $pemupukan)
    {
        //
        $pemupukan->delete();
        return redirect('/pemupukan')->with('success','berhasil hapus data');
    }
}
