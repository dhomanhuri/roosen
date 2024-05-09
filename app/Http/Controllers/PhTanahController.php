<?php

namespace App\Http\Controllers;

use App\Models\PhTanah;
use Illuminate\Http\Request;

class PhTanahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $phtanah = PhTanah::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.phtanah',compact('phtanah'));
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
            'tanggal_sebar' => 'required',
            'volume_dolomit' => 'required',
            'tanggal_pengukuran' => 'required',
            'ph' => 'required',
        ]);


        PhTanah::create([
            'user_id' => auth()->user()->id,
            'tanggal_sebar' => $request->tanggal_sebar,
            'volume_dolomit' => $request->volume_dolomit,
            'tanggal_pengukuran' => $request->tanggal_pengukuran,
            'ph' => $request->ph,
        ]);

        return redirect('/phtanah')->with('success','berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhTanah  $phTanah
     * @return \Illuminate\Http\Response
     */
    public function show(PhTanah $phTanah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhTanah  $phTanah
     * @return \Illuminate\Http\Response
     */
    public function edit(PhTanah $phTanah,$id)
    {
        //
        $phTanahEdit = PhTanah::findOrFail($id);
        if ( $phTanahEdit->user_id !== auth()->user()->id ){
            return redirect('/phtanah');
        }
        $phtanah = PhTanah::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.phtanah',compact('phTanahEdit','phtanah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhTanah  $phTanah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PhTanah $phTanah,$id)
    {
        //

        $request->validate([
            'tanggal_sebar' => 'required',
            'volume_dolomit' => 'required',
            'tanggal_pengukuran' => 'required',
            'ph' => 'required',
        ]);

        $phtanah = PhTanah::findOrFail($id);

        $phtanah->update([
            'user_id' => auth()->user()->id,
            'tanggal_sebar' => $request->tanggal_sebar,
            'volume_dolomit' => $request->volume_dolomit,
            'tanggal_pengukuran' => $request->tanggal_pengukuran,
            'ph' => $request->ph,
        ]);

        return redirect('/phtanah')->with('success','berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhTanah  $phTanah
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhTanah $phTanah,$id)
    {
        //
        $phtanah = PhTanah::findOrFail($id);
        $phtanah->delete();
        return redirect('/phtanah')->with('success','berhasil delete data');
    }
}
