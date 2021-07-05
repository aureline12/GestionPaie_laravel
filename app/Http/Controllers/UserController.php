<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        $users = DB::table('users')->where('status', '1')->get();
        return view('users.index', compact('users'));
    }

    public function show()
    {
        return view('users.profil', array('user' => Auth::user()));
    }

    public function store(){
        $data = request()->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'min:9', 'max:9', 'unique:users'],
            'role'      => ['required', 'string', 'max:255'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'telephone' => $data['telephone'],
            'role'      => $data['role'],
            'password'  => Hash::make($data['password']),
        ]);
        Session::flash('statuscode' , 'success');
        return redirect('/users')->with('status' , 'Nouvel Utilisateur Enregistré');
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('users.useredit', compact('users'));
    }

    public function create()
    {
        return view('auth.register');
    }

    public function update(Request $req, $id)
    {

        $users = User::find($id);

        if($users->email !== request('email')){
            request()->validate([
                'name'      => 'required|string|min:1|max:256',
                'telephone' => 'required|integer|min:9',
                'email'     =>'required|email|max:256|unique:employe|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'role'      => 'required|min:1|max:256',
            ]);
        }else{
            request()->validate([

                'name'      => 'required|string|min:1|max:256',
                'telephone' => 'required|integer|min:9',
                'role'      => 'required|min:1|max:256',

            ]);
        }
        

        $users->name = $req->input('name');
        $users->email = $req->input('email');
        $users->telephone = $req->input('telephone');
        $users->role = $req->input('role');
        $users->update();
        Session::flash('statuscode', 'info');
        return  redirect('/users')->with('status', 'Utilisateur modifié avec succès');
    }


    public function editprofil($id)
    {
        $users = User::find($id);
        return view('profile.profileedit')->with('users', $users);
    }

    public function updateprofil(Request $req, $id){


        request()->validate([
            'profile'       => 'sometimes|mimes:jpeg,jpg,png|max:5000',
            'name'          => 'required|string',
            'telephone'     => 'required|string|min:9',
            'email'         => 'required|email|max:256|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',

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
        return  redirect('/profile')->with('status', 'Votre profil a été modifié');
    }

    public function destroy($id)
    {

        $users = User::findOrFail($id);

        $destination = 'storage/images/' . $users->profile;
        
        User::where('id', $id)
            ->update(['status' => 0]);
        Session::flash('statuscode', 'error');
        return redirect('/users')->with('status', 'Utilisateur supprimé');
    }
}
