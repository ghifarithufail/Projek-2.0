<?php

namespace App\Exports;

use App\Models\Anggota;
use App\Models\Korhan;
use App\Models\KorTps;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Reservation;

class KorhanExport implements FromView
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $filters = $this->filters;

        $query = KorTps::withCount(['anggotas as anggotas_count' => function ($query) {
            $query->where('deleted', '0');
        }])
        ->where('deleted', '0')
        ->where('korhan_id', $filters)
        ->orderBy('created_at', 'asc');



        $korhan = $query->get();

        $data = Korhan::findOrFail($filters);
        $jumlahKonstituante = $korhan->sum('anggotas_count');
        $jumlahKortps = $korhan->count();


        return view('korhan.excel', [
            'korhan' => $korhan,
            'data' => $data,
            'jumlahKonstituante' => $jumlahKonstituante,
            'jumlahKortps' => $jumlahKortps,
        ]);
    }
}

