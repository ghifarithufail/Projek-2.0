<?php

namespace App\Exports;

use App\Models\Anggota;
use App\Models\KorTps;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnggotaExport implements FromView, ShouldAutoSize
{
    private $anggota;
    private $kortps;
    private $jumlahAnggota;

    public function __construct($anggota, $kortps, $jumlahAnggota)
    {
        $this->anggota = $anggota;
        $this->kortps = $kortps;
        $this->jumlahAnggota = $jumlahAnggota;
    }

    public function view(): View
    {
        return view('kortps.excel', [
            'anggota' => $this->anggota,
            'kortps' => $this->kortps,
            'jumlahAnggota' => $this->jumlahAnggota,
        ]);
    }
}

