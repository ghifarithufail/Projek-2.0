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

class KorTpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KorTps::orderBy('created_at', 'desc');

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

        $kortps = new KorTps($validatedData);
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

    public function detail($id){
        $tpsrw = Tpsrw::withCount('kortps')->findOrFail($id);

        return view('kortps.detail', compact('tpsrw'));
    }

    public function report(Request $request){
        $query = KorTps::withCount('anggotas');

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

        $kortps = $query->get();

        // dd($kortps);
        return view('kortps.report', compact('kortps'));
    }
    public function details($id){
        $anggota = Anggota::where('koordinator_id', $id)->paginate(15);
        $kortps = KorTps::find($id);
        $jumlahAnggota = $anggota->total(); // Use the total method to get the total count
    
        return view('kortps.details', compact('anggota', 'kortps', 'jumlahAnggota'));
    }

    public function pdf($id){
        $anggota = Anggota::where('koordinator_id',$id)->get();
        $kortps = KorTps::find($id);
        $jumlahAnggota = $anggota->count();

        // dd($korhan);
        return view('kortps.pdf', compact('anggota','kortps','jumlahAnggota'));
    }

   

    public function download($id){
        $anggota = Anggota::where('koordinator_id',$id)->get();
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

    public function excel($id)
    {

        $tanggal = Carbon::today()->format('D d-M-Y');
        $filters = $id;
        $name    = 'kortps '. $tanggal . '.xlsx';
        // dd($filters);
        return Excel::download(new KortpsExport($filters), $name);

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KorTps $korTps)
    {
        //
    }
}
