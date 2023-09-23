<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Partai;
use App\Models\SuaraCaleg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuaraCalegController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suara = SuaraCaleg::with('tpsrws','calegs','partais')
        ->where('deleted', '0')
        ->orderBy('created_at', 'desc')->get();

        return view('suara_caleg.index', compact('suara'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $caleg = Caleg::all();
        $partai = Partai::all();

        return view('suara_caleg.create', compact('caleg', 'partai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tpsrw_id'=> 'required',
            'caleg_id'=> 'required',
            'suara_caleg'=> 'required',
            'partai_id'=> 'required',
            'dpr_ri'=> 'required',
            'dpr_prov'=> 'required',
            'dprd'=> 'required',
            'photo'=> 'required',
            'keterangan'=> 'required',
        ]);

        $suara = new SuaraCaleg($validatedData);
        $suara->photo = $request->file('photo')->store('suara_calegs');
        // dd($request);
        $suara->user_id = Auth::user()->id;
        $suara->save();

        return redirect()->route('suara');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuaraCaleg $suaraCaleg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $suara = SuaraCaleg::find($id);
        $caleg = Caleg::all();
        $partai = Partai::all();

        return view('suara_caleg.edit', compact('suara', 'caleg', 'partai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(empty($request->file('photo'))){
            $suara = SuaraCaleg::find($id);

            $suara->update([
            'tpsrw_id'=> $request->tpsrw_id,
            'caleg_id'=> $request->caleg_id,
            'suara_caleg'=> $request->suara_caleg,
            'partai_id'=> $request->partai_id,
            'dpr_ri'=> $request->dpr_ri,
            'dpr_prov'=> $request->dpr_prov,
            'dprd'=> $request->dprd,
            'keterangan'=> $request->keterangan,
            ]);
                return redirect()->route('suara');
        }
        else{
            $suara = SuaraCaleg::find($id);
            Storage::delete($suara->photo);
            // dd($request);
            $suara->update([
                'tpsrw_id'=> $request->tpsrw_id,
                'caleg_id'=> $request->caleg_id,
                'suara_caleg'=> $request->suara_caleg,
                'partai_id'=> $request->partai_id,
                'dpr_ri'=> $request->dpr_ri,
                'dpr_prov'=> $request->dpr_prov,
                'dprd'=> $request->dprd,
                'keterangan'=> $request->keterangan,
                'photo' => $request->file('photo')->store('suara_calegs'),
            ]);
                return redirect()->route('suara');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $suara = SuaraCaleg::find($id);
        
        $suara->deleted = 1;
        $suara->save();

        return redirect()->route('suara');
    }
}
