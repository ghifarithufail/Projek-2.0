<?php

namespace App\Http\Controllers;

use App\Exports\KortpsExport;
use App\Models\Anggota;
use App\Models\Kabkota;
use App\Models\Kelurahan;
use App\Models\Korhan;
use App\Models\KorTps;
use App\Models\Tpsrw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Excel;
use Illuminate\Support\Facades\Auth;

class KorTpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KorTps::where('deleted', '0')
        ->whereHas('korhans', function ($q){
            $q->where('deleted', '0');
        })
        ->whereHas('korhans.koordinators', function ($q){
            $q->where('deleted', '0');
        })
        ->orderBy('created_at', 'desc');

        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('nama_koordinator', 'like', '%' . $nama . '%');
        }
        if ($request->has('kelurahan')) {
            $nama = $request->input('kelurahan');
            $query->whereHas('kelurahans', function ($q) use ($nama) {
                    $q->where('nama_kelurahan', 'like', '%' . $nama . '%')
                    ->orWhere('kecamatan', 'like', '%' . $nama . '%');
                });
        }
        if ($request->has('korcam')) {
            $nama = $request->input('korcam');
            $query->whereHas('korhans', function ($q) use ($nama) {
                    $q->where('nama_koordinator', 'like', '%' . $nama . '%');
                });
        }

        $kortps = $query->paginate(15);

        return view('kortps.index', compact('kortps'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kota = Kabkota::orderBy('nama_kabkota', 'asc')->get();

        return view('kortps.create', compact('kota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_koordinator' => 'required',
            'phone' => 'required',
            'nik' => 'required|unique:kor_tps,nik',
            'nokk' => 'required',
            'kabkota_id' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan_id' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            // 'user_id' => 'required',
            'kelurahan_id' => 'required',
            'korhan_id' => 'required',
            // 'tps_id' => 'required',
        ], [
            'nama_koordinator.required' => 'nama harus diisi',
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
            'korhan_id.required' => 'korhan  harus diisi',
            // 'tps_id.required' => 'TPS  harus diisi',
        ]);

        $kortps = new KorTps($validatedData);
        $kortps->user_id = Auth::user()->id;
        $kortps->save();

        // Sinkronisasi mapel_id
        $kortps->tps_pivot()->sync($request->input('tps_id',[]));

        return redirect()->route('kortps');
    }

    /**
     * Display the specified resource.
     */
    public function show(KorTps $korTps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = KorTps::find($id);
        $tps  = Tpsrw::all();
        $kota = Kabkota::all();
        $korhan = Korhan::all();

        return view('kortps.edit', compact( 'tps', 'kota', 'data','korhan' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_koordinator' => 'required',
            'phone' => 'required',
            'nik' => 'required',
            'nokk' => 'required',
            'kabkota_id' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan_id' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
            // 'user_id' => 'required',
            'kelurahan_id' => 'required',
            'korhan_id' => 'required',
        ]);

        $kortps = KorTps::find($id);
        $kortps->update($validatedData);

        // Sinkronisasi mapel_id
        $kortps->tps_pivot()->sync($request->input('tps_id',[]));

        return redirect()->route('kortps');
    }

    public function detail($id)
    {
        $tpsrw = Tpsrw::withCount(['kortps as kortps_count' => function ($query) {
            $query->where('deleted', '=', 0);
        },
        'anggotas as anggotas_count' => function ($query) {
            $query->where('deleted', '=', 0);
        },'anggotas as anggotas_verified' => function ($query) {
            $query->where('verified', '=', 1);
        }])
        ->findOrFail($id);

        // dd($tpsrw);
    
        return view('kortps.detail', compact('tpsrw'));
    }
    public function report(Request $request){
        $query = KorTps::where('deleted','0')
        ->whereHas('korhans', function ($q){
            $q->where('deleted', '0');
        })
        ->whereHas('korhans.koordinators', function ($q){
            $q->where('deleted', '0');
        })
        ->withCount(['anggotas' => function ($q) {
            $q->where('deleted', 0);
        }]);

        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('nama_koordinator', 'like', '%' . $nama . '%');
        }
        if ($request->has('kelurahan')) {
            $nama = $request->input('kelurahan');
            $query->whereHas('kelurahans', function ($q) use ($nama) {
                $q->where('nama_kelurahan', 'like', '%' . $nama . '%')
                    ->orWhere('kecamatan', 'like', '%' . $nama . '%');
            });
        }
        if ($request->has('korhan')) {
            $nama = $request->input('korhan');
            $query->whereHas('korhans', function ($q) use ($nama) {
                $q->where('nama_koordinator', 'like', '%' . $nama . '%');
            });
        }

        $kortps = $query->paginate(15);
        return view('kortps.report', compact('kortps'));
    }

    public function details(Request $request,$id){

        
        $query = Anggota::where('koordinator_id', $id)
        ->with('kabkotas','tps','koordinators')
        ->where('deleted', '0');
        if ($request->has('nama')) {
            $nama = $request->input('nama');
            $query->where('nama_anggota', 'like', '%' . $nama . '%');
        }
        if ($request->has('nik')) {
            $nik = $request->input('nik');
            $query->where('nik', 'like', '%' . $nik . '%');
        }
        if ($request->has('verifikasi')) {
            $status = $request->input('verifikasi');
            $query->where('verified','like', '%' . $status . '%');
        }


        $anggota = $query->paginate(15);


        $kortps = KorTps::find($id);
        $jumlahAnggota = $anggota->total(); 

        $verifiedCount = Anggota::where('koordinator_id', $id)
        ->where('deleted', '0')
        ->where('verified', '1')
        ->count();
    
        $anggota->appends($request->all());
        return view('kortps.details', compact('anggota', 'kortps', 'jumlahAnggota', 'verifiedCount'));
    }

    public function pdf($id){
        $anggota = Anggota::where('koordinator_id',$id)
        ->with('kabkotas','tps','koordinators')
        ->where('deleted', '0')
        ->where('verified','1')
        ->get();

        $kortps = KorTps::find($id);
        $jumlahAnggota = $anggota->count();
        

        // dd($korhan);
        return view('kortps.pdf', compact('anggota','kortps','jumlahAnggota'));
    }

    public function excel($id)
    {

        $anggota = Anggota::find($id);
        $nama = $anggota->nama_anggota;
        $tanggal = Carbon::today()->format('D d-M-Y');
        $filters = $id;
        $name    = 'kortps '. $nama . ' '. $tanggal . '.xlsx';
        // dd($filters);
        return Excel::download(new KortpsExport($filters), $name);

    }


    public function download($id){
        $anggota = Anggota::with('kabkotas','tps')->where('koordinator_id',$id)->get();
        $kortps = KorTps::find($id);
        $jumlahAnggota = $anggota->count();

        $data = [
            'anggota' => $anggota,
            'kortps' => $kortps,
            'jumlahAnggota' => $jumlahAnggota,
        ];


        $currentDate = now()->format('Y-m-d');


        $coordinatorName = $kortps->nama_koordinator;

        $pdfFileName = 'KORTPS_' . $coordinatorName . '_' . $currentDate  . '.pdf';

        $pdf = PDF::loadView('kortps.download', $data);
    
        $pdf->setPaper('letter', 'landscape');
        
        return $pdf->download($pdfFileName);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kortps = KorTps::find($id);
        
        $kortps->deleted = 1;
        $kortps->save();

        return redirect()->route('kortps');
    }
}
