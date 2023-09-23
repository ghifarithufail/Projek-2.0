<?php

namespace App\Http\Controllers;

use App\Models\Partai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partai = Partai::where('deleted', '0')->orderBy('created_at', 'DESC')->get();

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
        $partai->foto = $request->file('foto')->store('partais');
        $partai->save();

        return redirect()->route('partai')->with('success','Partai Berhasil Dibuat!!');
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
        if(empty($request->file('foto'))){
            $partai = Partai::find($id);

            $partai->update([
                'nama' => $request->nama,
                'partai' => $request->partai,
            ]);

            return redirect()->route('partai');
        }
        else{
            $partai = Partai::find($id);
            Storage::delete($partai->foto);
            $partai->update([
                'nama' => $request->nama,
                'partai' => $request->partai,
                'partai' => $request->partai,
                'foto' => $request->file('foto')->store('partais'),
            ]);

        return redirect()->route('partai');
        }

        return redirect()->route('partai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partai = Partai::find($id);
        
        $partai->deleted = 1;
        $partai->save();

        return redirect()->route('partai');
    }
}
