<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class LoginController extends Controller
{

    public function loginUser(){

        return view('user.login');
    }

    public function index(Request $request){
        $query = User::orderBy('created_at', 'desc')->where('deleted','0');

        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('name', 'like', '%' . $nama . '%');
        }
        if ($request->has('username')) {
            $nama = $request->input('username');
            $query->where('username', 'like', '%' . $nama . '%');
        }
        if ($request->has('role')) {
            $nama = $request->input('role');
            $query->where('role', 'like', '%' . $nama . '%');
        }
        $user = $query->paginate(15);
        
        $user->appends($request->all());

        return view('user.index', compact('user'));
    }
    public function create(){

        return view('user.create');
    }

    public function store(Request $request){
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'status' => $request->status,
            'role' => $request->role,
            'role2' => $request->role2
        ]);

        return redirect()->route('user');
    }

    public function login(Request $request){
        $credentials = $request->only('password', 'username');
    
        // Attempt to authenticate the user
        if(Auth::attempt($credentials) && Auth::user()->status == 0){
            return redirect('/');
        }
    
        // If authentication fails or the status is not 0, redirect back to login
        return redirect('/login');
    }

    public function logout(){
        Auth::logout();

        return redirect('/login');
    }

    public function edit($id){
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        // Validasi input sesuai kebutuhan
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'username' => 'required',
            'status' => 'required',
            'role' => 'required',
            'role2' => 'nullable',
        ]);
    
        // Perbarui data pengguna yang tidak termasuk kata sandi
        $user->update($validatedData);
    
        // Periksa apakah kata sandi diisi atau tidak
        if (!empty($request->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }
    
        return redirect()->route('user');
    }
    

    public function destroy($id)
    {
        $user = User::find($id);
        
        $user->deleted = 1;
        $user->status = 1;
        $user->save();

        return redirect()->route('user');
    }


    // public function update(Request $request, $id){
    //     $validatedData = $request->validate([
    //         'name' => 'required' ,
    //         'email' => 'required' ,
    //         'password' => 'required' ,
    //         'username' => 'required' ,
    //         'status' => 'required' ,
    //         'role' => 'required' ,
    //     ]);

    //     $user = User::find($id);
    //     if ($request->has('password')) {
    //         $validatedData['password'] = bcrypt($validatedData['password']);
    //     }
    
    //     $user->update($validatedData);

    //     return redirect()->route('user');
    // }
}
