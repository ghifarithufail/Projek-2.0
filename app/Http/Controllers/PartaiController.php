<?php

namespace App\Http\Controllers;

use App\Models\Partai;
use Illuminate\Http\Request;

class PartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partai = Partai::all();

        return view('partai.index', compact('partai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto' => 'required',
            'nama' => 'required',
            'partai' => 'required'
        ]);

        $partai = new Partai($validatedData);
        $partai->save();

        return redirect()->route('partai');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partai $partai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $partai = Partai::find($id);

        return view('partai.edit', compact('partai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'foto' => 'required',
            'nama' => 'required',
            'partai' => 'required'
        ]);
        
        $partai = Partai::find($id);
        $partai->update($validatedData);

        return redirect()->route('partai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partai $partai)
    {
        //
    }
}
