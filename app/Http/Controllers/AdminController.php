<?php

namespace App\Http\Controllers;

use App\Charts\KonstituanteBulananChart;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('home');
    }

    public function admin(){
        return view('admin');
    }
}
