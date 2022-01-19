<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = user::all();
        return view('user.userIndex',compact('user'));
    }
    public function create(){
        return view('user.userTambah');
    }
    public function store(Request $request){
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('userIndex')->with('sukses','Data Berhasil Disimpan');
    }
    public function destroy(user $id){
        $id->delete();
        return redirect()->route('userIndex')->with('sukses','Data Berhasil Dihapus');
    }
    public function edit(user $id){
        return view('user.userEdit',compact('id'));        
    }
    public function update(Request $request, user $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:8'],
        ]);;
        $requestData = $request->all();
        // $requestData['password']=Hash::make($request->password),
        $id->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('userIndex')->with('sukses','Data Berhasil Dirubah');
    }
}
