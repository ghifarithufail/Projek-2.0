<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Dapil;
use App\Models\Partai;
use Illuminate\Http\Request;

class CalegController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caleg = Caleg::all();
        return view('caleg.index', compact('caleg'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partai = Partai::all();
        $dapil = Dapil::all();

        return view('caleg.create', compact('dapil', 'partai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'partai_id' => 'required',
            'namacaleg'=> 'required',
            'no_urut'=> 'required',
            'jk'=> 'required',
            'kandidat'=> 'required',
            'dapil_id'=> 'required',
            'status'=> 'required',
            'photo'=> 'required',
        ]);

        $caleg = new Caleg($validatedData);
        $caleg->save();

        return redirect()->route('caleg');
    }

    /**
     * Display the specified resource.
     */
    public function show(Caleg $caleg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $caleg = Caleg::find($id);
        $partai = Partai::all();
        $dapil = Dapil::all();

        return view('caleg.edit', compact('caleg','partai','dapil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'partai_id' => 'required',
            'namacaleg'=> 'required',
            'no_urut'=> 'required',
            'jk'=> 'required',
            'kandidat'=> 'required',
            'dapil_id'=> 'required',
            'status'=> 'required',
            'photo'=> 'required',
        ]);

        $caleg = Caleg::find($id);
        $caleg->update($validatedData);

        return redirect()->route('caleg');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caleg $caleg)
    {
        //
    }
}
