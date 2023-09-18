<?php

namespace App\Http\Controllers;

use App\Charts\KonstituanteBulananChart;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(KonstituanteBulananChart $chart){
        $chart = $chart->build();

        return view('dashboard', compact('chart'));
    }
}
