<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $petani = User::where('role','petani')->get();
        return view('petani.index',compact('petani'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('petani.create');
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
            'name' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required|min:8',
            'alamat_rumah' => 'required',
            'alamat_lahan' => 'required',
            'luas_lahan' => 'required',
            'jenis_tanaman' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'petani',
            'alamat_rumah' => $request->alamat_rumah,
            'alamat_lahan' => $request->alamat_lahan,
            'luas_lahan' => $request->luas_lahan,
            'jenis_tanaman' => $request->jenis_tanaman,
            'foto' => $request->file('foto')->store('userfoto'),
        ]);

        return redirect('/petani')->with('success','berhasil menambahkan petani');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $petani = User::find($id);
        return view('petani.edit',compact('petani'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $petani = User::find($id);

        $validation = [
            'name' => 'required',
            'email' => $request->email == $petani->email ? '' : 'email|unique:users',
            'password' => empty($request->password) ? '' : 'required|min:8',
            'alamat_rumah' => 'required',
            'alamat_lahan' => 'required',
            'luas_lahan' => 'required',
            'jenis_tanaman' => 'required',
            'foto' => empty($request->file('foto')) ? '' : 'required|image|mimes:jpeg,png,jpg'
        ];


        $request->validate($validation);

        if ( !empty($request->file('foto')) ){
            Storage::delete($petani->foto);
        }


        $petani->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $petani->password == $request->password ? $petani->password : bcrypt($request->password),
            'role' => 'petani',
            'alamat_rumah' => $request->alamat_rumah,
            'alamat_lahan' => $request->alamat_lahan,
            'luas_lahan' => $request->luas_lahan,
            'jenis_tanaman' => $request->jenis_tanaman,
            'foto' => empty($request->file('foto')) ? $petani->foto : $request->file('foto')->store('userfoto'),
        ]);


        return redirect('/petani')->with('success','data berhasil di update');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $petani = User::find($id);
        Storage::delete($petani->foto);
        $petani->delete();

        return redirect('/petani')->with('success','berhasil menghapus petani');


    }
}
