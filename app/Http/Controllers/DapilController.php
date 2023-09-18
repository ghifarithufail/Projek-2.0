<?php

namespace App\Http\Controllers;

use App\Models\Dapil;
use Illuminate\Http\Request;

class DapilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dapil = Dapil::all();

        return view('dapil.index', compact('dapil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dapil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dapil' => 'required',
            'wilayah' => 'required',
            'keterangan' => 'required'
        ]);

        $dapil = new Dapil($validatedData);
        $dapil->save();

        return redirect()->route('dapil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dapil $dapil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dapil = Dapil::find($id);

        return view('dapil.edit', compact('dapil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_dapil' => 'required',
            'wilayah' => 'required',
            'keterangan' => 'required'
        ]);
        
        $dapil = Dapil::find($id);
        $dapil->update($validatedData);

        return redirect()->route('dapil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dapil $dapil)
    {
        //
    }
}
