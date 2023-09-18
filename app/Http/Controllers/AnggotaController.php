<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kabkota;
use App\Models\Korcam;
use App\Models\KorTps;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = Anggota::all();

        return view('anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kota = Kabkota::all();
        $korcam = KorTps::all();

        return view('anggota.create', compact('kota', 'korcam'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'nokk'=> 'required',
        'nik'=> 'required',
        'nama_anggota'=> 'required',
        'kabkota_id'=> 'required',
        'tgl_lahir'=> 'required',
        'alamat'=> 'required',
        'rt'=> 'required',
        'rw'=> 'required',
        'tpsrw_id'=> 'required',
        'phone'=> 'required',
        'status'=> 'required',
        'keterangan'=> 'required',
        'koordinator_id'=> 'required',
        ]);
        
        $anggota = new Anggota($validatedData);
        $anggota->save();


        return redirect()->route('anggota');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anggota = Anggota::find($id);
        $kota = Kabkota::all();

        return view('anggota.edit', compact('anggota','kota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nokk'=> 'required',
            'nik'=> 'required',
            'nama_anggota'=> 'required',
            'kabkota_id'=> 'required',
            'tgl_lahir'=> 'required',
            'alamat'=> 'required',
            'rt'=> 'required',
            'rw'=> 'required',
            'tpsrw_id'=> 'required',
            'phone'=> 'required',
            'status'=> 'required',
            'keterangan'=> 'required',
            'koordinator_id'=> 'required',
            ]);

        $anggota = Anggota::find($id);
        $anggota->update($validatedData);

        return redirect()->route('anggota');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        //
    }
}
