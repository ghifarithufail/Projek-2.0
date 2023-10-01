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
    public function index(Request $request)
    {

        
        $query = Anggota::where('deleted','0')
        ->whereHas('koordinators', function ($q){
            $q->where('deleted', '0');
        })
        ->whereHas('koordinators.korhans', function ($q){
            $q->where('deleted', '0');
        })
        ->whereHas('koordinators.korhans.koordinators', function ($q){
            $q->where('deleted', '0');
        })
        ->orderBy('created_at', 'desc');

        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('nama_anggota', 'like', '%' . $nama . '%');
        }
        if ($request->has('kelurahan')) {
            $nama = $request->input('kelurahan');
            $query->whereHas('tps.kelurahans', function ($q) use ($nama) {
                    $q->where('nama_kelurahan', 'like', '%' . $nama . '%')
                    ->orWhere('kecamatan', 'like', '%' . $nama . '%');
                });
        }
        if ($request->has('kortps')) {
            $nama = $request->input('kortps');
            $query->whereHas('koordinators', function ($q) use ($nama) {
                    $q->where('nama_koordinator', 'like', '%' . $nama . '%');
                });
        }

        $anggota = $query->paginate(15);

        $anggota->appends($request->all());

        return view('anggota.index', compact('anggota'));
    }

    public function download(Request $request)
    {
        $tanggal = Carbon::today()->format('D d-M-Y');
        $filters = $request->all();
        $name    = 'Reservation '. $tanggal . '.xlsx';
        // dd($filters);
        return Excel::download(new ReservationExport($filters), $name);
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
        'nik'=> 'required|unique:anggotas,nik',
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
        ], [
            'nama_anggota.required' => 'nama harus diisi',
            'phone.required' => 'No Telpon harus diisi',
            'nik.required' => 'NIK harus diisi',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nokk.required' => 'KK harus diisi',
            'kabkota_id.required' => 'KABKOTA harus diisi',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi',
            'rt.required' => 'RT harus diisi',
            'rw.required' => 'RW harus diisi',
            'kelurahan_id.required' => 'KELURAHAN harus diisi',
            'status.required' => 'Status harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
            'alamat.required' => 'Alamat  harus diisi',
            'koordinator_id.required' => 'korhan  harus diisi',
            'tpsrw_id.required' => 'TPS  harus diisi',
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
    public function destroy($id)
    {
        $anggota = Anggota::find($id);
        
        $anggota->deleted = 1;
        $anggota->save();

        return redirect()->route('anggota');
    }

    public function verifikasi(Request $request)
    {
        $query = Anggota::where('deleted','0')
        ->whereHas('koordinators', function ($q){
            $q->where('deleted', '0');
        })
        ->whereHas('koordinators.korhans', function ($q){
            $q->where('deleted', '0');
        })
        ->whereHas('koordinators.korhans.koordinators', function ($q){
            $q->where('deleted', '0');
        })
        ->orderBy('verified', 'asc')
        ->orderBy('created_at', 'desc');

        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('nama_anggota', 'like', '%' . $nama . '%');
        }
        if ($request->has('kelurahan')) {
            $nama = $request->input('kelurahan');
            $query->whereHas('tps.kelurahans', function ($q) use ($nama) {
                    $q->where('nama_kelurahan', 'like', '%' . $nama . '%')
                    ->orWhere('kecamatan', 'like', '%' . $nama . '%');
                });
        }
        if ($request->has('kortps')) {
            $nama = $request->input('kortps');
            $query->whereHas('koordinators', function ($q) use ($nama) {
                    $q->where('nama_koordinator', 'like', '%' . $nama . '%');
                });
        }

        $anggota = $query->paginate(15);
        $anggota->appends($request->all());


        return view('anggota.verifikasi', compact('anggota'));
    }

    public function verifTrue($id)
    {
        $anggota = Anggota::find($id);
        
        $anggota->verified = 1;
        $anggota->save();

        return redirect()->route('anggota/verifikasi');
    }

    public function verifFalse($id)
    {
        $anggota = Anggota::find($id);
        
        $anggota->verified = 2;
        $anggota->save();

        return redirect()->route('anggota/verifikasi');
    }
}
