<?php

namespace App\Exports;

use App\Models\Anggota;
use App\Models\KorTps;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KortpsExport implements FromView, ShouldAutoSize
{
    protected $filters;
    protected $request;

    public function __construct($filters,$request)
    {
        $this->filters = $filters;
        $this->request = $request;
     
    }

    public function view(): View
    {
        $filters = $this->filters;
        $request = $this->request;
 

        $anggota = Anggota::with('kabkotas','tps','koordinators')
        ->where('deleted', '0')
        ->where('verified','1')
        ->where('koordinator_id', $filters)
        ->where('tpsrw_id', $request);

        
        $kortps = KorTps::find($filters);
        $jumlahAnggota = $anggota->count();

        // dd($data);
        return view('kortps.excel', [
            'anggota' => $anggota->get(),
            'kortps' => $kortps,
            'jumlahAnggota' => $jumlahAnggota,
        ]);
    }
}

