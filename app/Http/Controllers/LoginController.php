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

    public function index(){
        $user = User::orderBy('created_at', 'desc')->get();

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
        ]);

        return redirect()->route('user/create');
    }

    public function login(Request $request){
        if(Auth::attempt($request->only('password','username'))){
            return redirect('/chart');
        }

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
