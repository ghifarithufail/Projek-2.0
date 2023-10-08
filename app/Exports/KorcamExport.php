<?php

namespace App\Exports;

use App\Models\Anggota;
use App\Models\Korcam;
use App\Models\Korhan;
use App\Models\KorTps;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KorcamExport implements FromView, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $filters = $this->filters;

        $query = Korhan::where('korcam_id', $filters)
        ->where('deleted', '0')
        ->with('kortps')
        ->withCount(['kortps as anggota_count' => function ($query) {
            $query->leftJoin('anggotas', 'kor_tps.id', '=', 'anggotas.koordinator_id')
                ->where('anggotas.deleted', '0'); // Change 'deleted' to 'anggotas.deleted'
        }]);

        $korhan = $query->get();

        $korcam = Korcam::findOrFail($filters);
        $jumlahKorhan = $korhan->count();
        $jumlahKonstituante = $korhan->sum('anggota_count');


        return view('korcam.excel', [
            'korcam' => $korcam,
            'korhan' => $korhan,
            'jumlahKonstituante' => $jumlahKonstituante,
            'jumlahKorhan' => $jumlahKorhan,
        ]);
    }
}

