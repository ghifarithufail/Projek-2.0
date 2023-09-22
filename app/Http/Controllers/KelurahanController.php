<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Korhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('kelurahans')
            ->select('kelurahans.nama_kelurahan as kelurahan', 'kelurahans.id', 
            'kecamatan', 'dapil', 'kabkota', 'provinsi', 'kode_kel', 
            DB::raw('COUNT(CASE WHEN anggotas.deleted = 0 THEN anggotas.id END) as anggota_count'))
            ->leftJoin('tpsrws', 'kelurahans.id', '=', 'tpsrws.kelurahan_id')
            ->leftJoin('anggotas', function ($join) {
                $join->on('tpsrws.id', '=', 'anggotas.tpsrw_id')
                    ->where('anggotas.deleted', '=', '0');
            })
            ->groupBy('kelurahans.id', 'kelurahans.nama_kelurahan');

    
        if ($request->has('kelurahan')) {
            $search = $request->input('kelurahan');
            $query->where('kelurahans.nama_kelurahan', 'like', '%' . $search . '%');
        }

        if ($request->has('kecamatan')) {
            $search = $request->input('kecamatan');
            $query->where('kelurahans.kecamatan', 'like', '%' . $search . '%');
        }
    
        $kelurahan = $query->paginate(15);
    
        return view('Kelurahan.index', compact('kelurahan'));
    }
    
    public function detail($id){
        
        $korhan = Korhan::where('korcam_id', $id)
        ->where('deleted', '0')
        ->with('kortps')
        ->withCount(['kortps as anggota_count' => function ($query) {
            $query->leftJoin('anggotas', 'kor_tps.id', '=', 'anggotas.koordinator_id')
                ->where('anggotas.deleted', '0'); // Change 'deleted' to 'anggotas.deleted'
        }])->get();

        $kelurahan = Kelurahan::find($id);
        $jumlahKorhan = $korhan->count();

        return view('kelurahan.detail', compact('korhan','kelurahan','jumlahKorhan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelurahan $kelurahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelurahan $kelurahan)
    {
        //
    }
}
