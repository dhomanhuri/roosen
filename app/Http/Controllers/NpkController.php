<?php

namespace App\Http\Controllers;

use App\Models\Npk;
use Illuminate\Http\Request;

class NpkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $npk = Npk::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.npk',compact('npk'));
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
            'n' => 'required',
            'p' => 'required',
            'k' => 'required',
        ]);


        Npk::create([
            'user_id' => auth()->user()->id,
            'tanggal' => $request->tanggal,
            'n' => $request->n,
            'p' => $request->p,
            'k' => $request->k,
        ]);

        return redirect('/npk')->with('success','berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Npk  $npk
     * @return \Illuminate\Http\Response
     */
    public function show(Npk $npk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Npk  $npk
     * @return \Illuminate\Http\Response
     */
    public function edit(Npk $npk)
    {
        //
        $npkEdit = $npk;
        $npk = Npk::where('user_id',auth()->user()->id)->paginate(10);
        return view('lahan.npk',compact('npkEdit','npk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Npk  $npk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Npk $npk)
    {
        //
        $request->validate([
            'tanggal' => 'required',
            'n' => 'required',
            'p' => 'required',
            'k' => 'required',
        ]);


        $npk->update([
            'user_id' => auth()->user()->id,
            'tanggal' => $request->tanggal,
            'n' => $request->n,
            'p' => $request->p,
            'k' => $request->k,
        ]);

        return redirect('/npk')->with('success','berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Npk  $npk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Npk $npk)
    {
        //
        $npk->delete();
        return redirect('/npk')->with('success','berhasil delete data');
    }
}
