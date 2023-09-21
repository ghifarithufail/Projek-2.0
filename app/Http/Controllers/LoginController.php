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
        if(Auth::attempt($request->only('email','password','username'))){
            return redirect('/chart');
        }

        return redirect('/login');
    }

    public function logout(){
        Auth::logout();

        return redirect('/login');
    }
}
