<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('layout.index');
    }

    public function admin(){
        return view('admin');
    }
}
