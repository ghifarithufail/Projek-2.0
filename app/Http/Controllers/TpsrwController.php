<?php

namespace App\Http\Controllers;

use App\Models\Tpsrw;
use Illuminate\Http\Request;

class TpsrwController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tps = Tpsrw::orderBy('kelurahan_id', 'desc')->paginate(15);
        // $tps = Tpsrw::orderBy('kelurahan_id', 'desc')->paginate(15);
        $tps = Tpsrw::withCount('anggotas')->with('kelurahans')->whereHas('kelurahans', function ($query) {
            $query->orderBy('nama_kelurahan', 'asc');
        })->paginate(15);


        // dd($tps);
        return view('tps.index', compact('tps'));
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
    public function show(Tpsrw $tpsrw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tpsrw $tpsrw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tpsrw $tpsrw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tpsrw $tpsrw)
    {
        //
    }
}
