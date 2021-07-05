<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProfilController extends Controller
{
    public function index(){
        return view('users.profil.index', array('user' => Auth::user()));
    }

    public function edit($id){
        $users = User::find($id);
        return view('users.profil.edit')->with('users', $users);
    }

    public function update(Request $req, $id){

        request()->validate([
        'profile' => 'sometimes|mimes:jpeg,jpg,png|max:5000',
        'name' => 'required|string',
        'telephone' => 'required|string|min:9',
        'email' => 'required|email|max:256|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',

        ]);

        $users = User::find($id);

        $users->name = $req->input('name');
        $users->email = $req->input('email');
        $users->telephone = $req->input('telephone');

        if ($req->hasfile('profile')) {

            $destination = 'storage/images/' . $users->profile;

            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $req->file('profile');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('storage/images/', $filename);

            $users->profile = $filename;
        }
        $users->update();
        Session::flash('statuscode', 'info');
        return redirect('/profile')->with('status', 'Votre profil a été modifié');
    }

}
