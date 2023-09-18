<?php

namespace App\Http\Controllers;

use App\Models\Kabkota;
use App\Models\Kelurahan;
use App\Models\Korcam;
use App\Models\Korhan;
use App\Models\KorTps;
use App\Models\Tpsrw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KorhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Korhan::orderBy('created_at', 'desc');

        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('nama_koordinator', 'like', '%' . $nama . '%');
        }
        if ($request->has('kelurahan')) {
            $nama = $request->input('kelurahan');
            $query->whereHas('kelurahans', function ($q) use ($nama) {
                    $q->where('nama_kelurahan', 'like', '%' . $nama . '%')
                    ->orWhere('kecamatan', 'like', '%' . $nama . '%');
                });
        }
        if ($request->has('korcam')) {
            $nama = $request->input('korcam');
            $query->whereHas('koordinators', function ($q) use ($nama) {
                    $q->where('nama_koordinator', 'like', '%' . $nama . '%');
                });
        }

        $korhan = $query->paginate(15);

        return view('korhan.index', compact('korhan'));
    }

    public function report(Request $request){
        $query = Korhan::withCount('kortps')->orderBy('created_at', 'desc');

        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('nama_koordinator', 'like', '%' . $nama . '%');
        }
        if ($request->has('kelurahan')) {
            $nama = $request->input('kelurahan');
            $query->whereHas('kelurahans', function ($q) use ($nama) {
                $q->where('nama_kelurahan', 'like', '%' . $nama . '%')
                    ->orWhere('kecamatan', 'like', '%' . $nama . '%');
            });
        }
        if ($request->has('korcam')) {
            $nama = $request->input('korcam');
            $query->whereHas('koordinators', function ($q) use ($nama) {
                $q->where('nama_koordinator', 'like', '%' . $nama . '%');
            });
        }
        
        $korhan = $query->paginate(15);


        return view('korhan.report', compact('korhan'));
    }

    public function details(Request $request, $id){
        $query = KorTps::withCount('anggotas')
        ->where('korhan_id', $id)
        ->orderBy('created_at', 'asc');

        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('nama_koordinator', 'like', '%' . $nama . '%');
        }
        if ($request->has('kelurahan')) {
            $nama = $request->input('kelurahan');
            $query->whereHas('kelurahans', function ($q) use ($nama) {
                $q->where('nama_kelurahan', 'like', '%' . $nama . '%')
                    ->orWhere('kecamatan', 'like', '%' . $nama . '%');
            });
        }

        $korhan = $query->get();

        $data = Korhan::findOrFail($id);
        $jumlahKonstituante = $korhan->sum('anggotas_count');
        $jumlahKortps = $korhan->count();


        return view('korhan.details', compact('korhan', 'data', 'jumlahKonstituante', 'jumlahKortps'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kota = Kabkota::orderBy('nama_kabkota', 'asc')->get();

        return view('korhan.create', compact( 'kota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_koordinator' => 'required',
            'phone' => 'required',
            'nik' => 'required',
            'nokk' => 'required',
            'kabkota_id' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan_id' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            // 'user_id' => 'required',
            'kelurahan_id' => 'required',
            'korcam_id' => 'required',
        ]);

        $korhan = new Korhan($validatedData);
        $korhan->save();

        // Sinkronisasi mapel_id
        $korhan->pivot_korhans()->sync($request->input('tpshan_id',[]));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Korhan $korhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Korhan::with('pivot_korhans')->find($id);
        $tps  = Tpsrw::all();
        $kota = Kabkota::all();
        $korcam = Korcam::all();

        // dd($data);

        return view('korhan.edit', compact( 'tps', 'kota', 'data','korcam' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_koordinator' => 'required',
            'phone' => 'required',
            'nik' => 'required',
            'nokk' => 'required',
            'kabkota_id' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan_id' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            // 'user_id' => 'required',
            'kelurahan_id' => 'required',
            'korcam_id' => 'required',
        ]);

        $korhan = Korhan::find($id);
        $korhan->update($validatedData);

        // Sinkronisasi mapel_id
        $korhan->pivot_korhans()->sync($request->input('tpshan_id',[]));

        return redirect()->route('korhan');
    }
    
    public function detail($id){
        $korhan = Korhan::where('kelurahan_id',$id)->get();
        $kelurahan = Kelurahan::find($id);
        $jumlahKorhan = $korhan->count();

        return view('korhan.detail', compact('korhan','kelurahan','jumlahKorhan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Korhan $korhan)
    {
        //
    }
}
