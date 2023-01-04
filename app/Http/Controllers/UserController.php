<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function profile($id){
        $user = User::find($id);

        return view('user.profile',compact('user'));
    }

    public function setting($id){

        $user = User::find($id);

        return view('user.setting',compact('user'));
    }

    public function settingUpdate(Request $request,$id){

        $user = User::find($id);

        $validate = [
            'name' => 'required',
            'email' => 'required|email'
        ];

        if ( empty($request->password) ){
            $password = $user->password;
        } else {
            $validate['password'] = 'required|min:8';
            $password = bcrypt($request->password);
        }

        if ( !$request->foto == NULL ){
            $validator = Validator::make($request->all(), [
                'foto' => 'image|mimes:jpeg,png,jpg',
            ]);

            if ( !$validator->fails()){
                Storage::delete($user->foto);
            }
        
          
            $validate['foto'] = 'image|mimes:jpeg,png,jpg';
        } 

        if ( $request->email !== $user->email ){
            $validate['email'] = 'required|email|unique:users';
        }

        $request->validate($validate);

        $foto = empty($request->foto) ? $user->foto : $request->file('foto')->store('userfoto');

        

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'foto' => $foto
        ]);
    

        return redirect('/user/setting/' . $id)->with('success', 'Profile berhasil di update');

    }


    public function deleteUser($id){
        $user = User::find($id);
        Storage::delete($user->foto);
        $user->delete();

        return redirect('/login')->with('success','Akun anda berhasil dihapus');
    }
}
