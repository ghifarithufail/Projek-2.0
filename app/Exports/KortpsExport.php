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
    protected $filterData;

    public function __construct($filters,$request,$filterData)
    {
        $this->filters = $filters;
        $this->request = $request;
        $this->filterData = $filterData;
    
    }

    public function view(): View
    {
        $filters = $this->filters;
        $request = $this->request;
        $filterData = $this->filters;
 

        $anggota = Anggota::with('kabkotas','tps','koordinators')
        ->where('deleted', '0')
        ->where('verified',$filterData)
        ->where('koordinator_id', $filters)
        ->where('tpsrw_id', $request);

        
        $kortps = KorTps::find($filters);
        $jumlahAnggota = $anggota->count();

        
        return view('kortps.excel', [
            'anggota' => $anggota->get(),
            'kortps' => $kortps,
            'jumlahAnggota' => $jumlahAnggota,
        ]);
    }
}

