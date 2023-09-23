<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Dapil;
use App\Models\Partai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CalegController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caleg = Caleg::where('deleted','0')->orderBy('created_at', 'DESC')->get();
        
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
        $caleg->photo = $request->file('photo')->store('calegs');
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
        // dd($request);

        if(empty($request->file('photo'))){
            $caleg = Caleg::find($id);

            $caleg->update([
                'namacaleg' => $request->namacaleg,
                'partai_id' => $request->partai_id,
                'no_urut' => $request->no_urut,
                'jk' => $request->jk,
                'kandidat' => $request->kandidat,
                'dapil_id' => $request->dapil_id,
                'status' => $request->status,
            ]);
                return redirect()->route('caleg');
        }
        else{
            $caleg = Caleg::find($id);
            Storage::delete($caleg->photo);
            // dd($request);
            $caleg->update([
                'namacaleg' => $request->namacaleg,
                'partai_id' => $request->partai_id,
                'no_urut' => $request->no_urut,
                'jk' => $request->jk,
                'kandidat' => $request->kandidat,
                'dapil_id' => $request->dapil_id,
                'status' => $request->status,
                'photo' => $request->file('photo')->store('calegs'),
            ]);
                return redirect()->route('caleg');
        }

        return redirect()->route('caleg');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $caleg = Caleg::find($id);
        
        $caleg->deleted = 1;
        $caleg->save();

        return redirect()->route('caleg');
    }
}
