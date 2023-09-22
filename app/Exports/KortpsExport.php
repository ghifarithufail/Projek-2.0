<?php

namespace App\Exports;

use App\Models\Anggota;
use App\Models\KorTps;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Reservation;

class KortpsExport implements FromView
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $filters = $this->filters;

        $anggota = Anggota::with('kabkotas','tps','koordinators')
        ->where('deleted', '0')
        ->where('koordinator_id', $filters);
        $kortps = KorTps::find($filters);
        $jumlahAnggota = $anggota->count();

        return view('kortps.excel', [
            'anggota' => $anggota->get(),
            'kortps' => $kortps,
            'jumlahAnggota' => $jumlahAnggota,
        ]);
    }
}

