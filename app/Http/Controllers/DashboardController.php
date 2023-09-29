<?php

namespace App\Http\Controllers;

use App\Charts\KonstituanteBulananChart;
use App\Models\Anggota;
use App\Models\Korcam;
use App\Models\Korhan;
use App\Models\KorTps;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(KonstituanteBulananChart $chart){
        $user = User::count();
        $korcam = Korcam::count();
        $korhan = Korhan::count();
        $kortps = KorTps::count();
        $anggota = Anggota::count();
        $verifikasi = Anggota::where('verified','1')->where('deleted','0')->count();
        $chart = $chart->build();

        return view('dashboard', compact('chart','user','kortps','anggota','verifikasi','korcam','korhan'));
    }
}
