<?php

namespace App\Http\Controllers;

use App\Models\Tpsrw;
use Illuminate\Http\Request;

class TpsrwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tpsrw::withCount(['anggotas as anggotas_count' => function ($q) {
            $q->where('deleted', '=', 0);
        },
        'anggotas as verified_anggotas_count' => function ($query) {
            $query->where('verified', '=', 1);
        }])->where('deleted', '=', 0)
        ->with('kelurahans')
        ->orderBy('created_at', 'desc');
        // ->paginate(15);

        if ($request->has('kelurahan')) {
            $nama = $request->input('kelurahan');
            $query->whereHas('kelurahans', function ($q) use ($nama) {
                $q->where('nama_kelurahan', 'like', '%' . $nama . '%');
            });
        }
        if ($request->has('kecamatan')) {
            $nama = $request->input('kecamatan');
            $query->whereHas('kelurahans', function ($q) use ($nama) {
                $q->where('kecamatan', 'like', '%' . $nama . '%');
            });
        }
        $tps = $query->paginate(15);


        $tps->appends($request->all());
    

        // dd($tps);
        return view('tps.index', compact('tps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tps' => 'required',
            'totdpt' => 'required',
            'dptl' => 'required',
            'dptp' => 'required',
            'lokasi' => 'required',
            'kelurahan_id' => 'required',
            'target' => 'required',

        ], [
            'kelurahan_id'=> 'Kelurahan harus diisi',
            'tps'=> 'TPS harus diisi',
            'totdpt'=> 'Total DPT harus diisi',
            'dptl'=> 'DPTL harus diisi',
            'dptp'=> 'DPTP harus diisi',
            'lokasi'=>'Lokasi harus diisi',
            'target'=>'Lokasi harus diisi',
        ]);

        // dd($request);
        $tps = new Tpsrw($validatedData);
        $tps->save();

        return redirect()->route('tps');
    
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tps = Tpsrw::find($id);

        return view('tps.edit', compact('tps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tps' => 'required',
            'totdpt' => 'required',
            'dptl' => 'required',
            'dptp' => 'required',
            'lokasi' => 'required',
            'kelurahan_id' => 'required',
            'target' => 'required',

        ], [
            'kelurahan_id'=> 'Kelurahan harus diisi',
            'tps'=> 'TPS harus diisi',
            'totdpt'=> 'Total DPT harus diisi',
            'dptl'=> 'DPTL harus diisi',
            'dptp'=> 'DPTP harus diisi',
            'lokasi'=>'Lokasi harus diisi',
            'target'=>'Lokasi harus diisi',
        ]);

        // dd($request);
        $tps = Tpsrw::find($id);
        $tps->update($validatedData);

        return redirect()->route('tps');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tps = Tpsrw::find($id);

        $tps->deleted = 1;
        $tps->save();

        return redirect()->route('tps');
    }
}
