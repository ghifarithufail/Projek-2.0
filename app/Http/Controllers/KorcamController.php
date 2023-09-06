<?php

namespace App\Http\Controllers;

use App\Models\Kabkota;
use App\Models\Kelurahan;
use App\Models\Korcam;
use App\Models\Tpsrw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KorcamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Korcam::orderBy('created_at', 'desc')->get();


        return view('korcam.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function getKelurahan(Request $request){
        $kelurahan=[];
        if($search=$request->name){
            $kelurahan = Kelurahan::where('nama_kelurahan', 'LIKE', "%$search%")->get();
        }
        return response()->json($kelurahan);
     }

     public function getTps(Request $request){
        $tps=[];

        $tps = Tpsrw::with('kelurahans')->whereHas('kelurahans', function($query) use ($request){
            $query->where('nama_kelurahan', 'LIKE', "%{$request->name}%");
        })->get();
        
        return response()->json($tps);
    }

    public function create()
    {
        // Cek apakah data dropdown sudah ada di cache
        $kelurahan = Cache::remember('kelurahan_dropdown', now()->addHours(1), function () {
            return Kelurahan::orderBy('nama_kelurahan', 'asc')->get();
        });

        $tps = Cache::remember('tps_dropdown', now()->addHours(1), function () {
            return Tpsrw::all();
        });

        $kota = Cache::remember('kota_dropdown', now()->addHours(1), function () {
            return Kabkota::orderBy('nama_kabkota', 'asc')->get();
        });

        return view('korcam.create', compact('kelurahan', 'tps', 'kota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Korcam::create([
            'nama_koordinator' => $request->nama_koordinator,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'nokk' => $request->nokk,
            'kabkota_id' => $request->kabkota_id,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan_id' => $request->kelurahan_id,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'user_id' => '1',
        ]);

        return redirect()->route('korcam');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Korcam::find($id);
        $kelurahan = Kelurahan::all();
        $tps  = Tpsrw::all();
        $kota = Kabkota::all();

        return view('korcam.edit', compact('kelurahan', 'tps', 'kota', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $data = Korcam::find($id);
        $data->update($request->all());

        return redirect()->route('korcam');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Korcam $korcam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Korcam $korcam)
    {
        //
    }
}
