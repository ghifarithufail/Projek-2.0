<?php

namespace App\Http\Controllers;

use App\Exports\KorcamExport;
use App\Models\Kabkota;
use App\Models\Kelurahan;
use App\Models\Korcam;
use App\Models\Korhan;
use App\Models\KorTps;
use App\Models\Tpsrw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use PDF;
use Excel;

class KorcamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Korcam::where('deleted', '0')->orderBy('created_at', 'desc');

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

        $data = $query->paginate(15);

        return view('korcam.index', compact('data'));
    }

    public function report(Request $request)
    {
        $query = Korcam::where('deleted','0')->withCount('korhansWithDeletedCount');

        // dd($query);
        // ->whereHas('korhans', function ($query) {
        //     $query->where('deleted', 0);
        // })->orderBy('created_at', 'desc');

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
        $data = $query->paginate(15);

        return view('korcam.report', compact('data'));
    }

    public function detail(Request $request, $id)
    {
        $query = Korhan::where('korcam_id', $id)
        ->where('deleted', '0')
        ->with('kortps')
        ->withCount(['kortps as anggota_count' => function ($query) {
            $query->leftJoin('anggotas', 'kor_tps.id', '=', 'anggotas.koordinator_id')
                ->where('anggotas.deleted', '0'); // Change 'deleted' to 'anggotas.deleted'
        }]);


        $korcam = Korcam::find($id);

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
            $query->whereHas('koordinators', function ($q) use ($nama) {
                $q->where('nama_koordinator', 'like', '%' . $nama . '%');
            });
        }

        $korhan = $query->paginate(15);


        $jumlahKorhan = $korhan->count();
        $jumlahKonstituante = $korhan->sum('anggota_count');

        return view('korcam.detail', compact('korhan', 'korcam', 'jumlahKorhan', 'jumlahKonstituante'));
    }

    public function pdf($id){
        $query = Korhan::where('korcam_id', $id)
        ->where('deleted', '0')
        ->with('kortps')
        ->withCount(['kortps as anggota_count' => function ($query) {
            $query->leftJoin('anggotas', 'kor_tps.id', '=', 'anggotas.koordinator_id')
                ->where('anggotas.deleted', '0'); // Change 'deleted' to 'anggotas.deleted'
        }]);

        $korhan = $query->get();

        $korcam = Korcam::findOrFail($id);
        $jumlahKorhan = $korhan->count();
        $jumlahKonstituante = $korhan->sum('anggota_count');

        return view('korcam.pdf', compact('korhan', 'korcam', 'jumlahKorhan', 'jumlahKonstituante'));
    }

    public function excel($id)
    {
        $korcam = Korcam::findOrFail($id);

        $nama = $korcam->nama_koordinator;
        $tanggal = Carbon::today()->format('D d-M-Y');
        $filters = $id;
        $name    = 'Korcam '. $nama. ' '. $tanggal . '.xlsx';

        return Excel::download(new KorcamExport($filters), $name);
    }

    public function download($id){
        
        $query = Korhan::where('korcam_id', $id)
        ->with('kortps')
        ->withCount(['kortps as anggota_count' => function ($query) {
            $query->leftJoin('anggotas', 'kor_tps.id', '=', 'anggotas.koordinator_id');
        }]);

        $korhan = $query->get();

        $korcam = Korcam::findOrFail($id);
        $jumlahKorhan = $korhan->count();
        $jumlahKonstituante = $korhan->sum('anggota_count');


        $data = [
            'korhan' => $korhan,
            'jumlahKonstituante' => $jumlahKonstituante,
            'jumlahKorhan' => $jumlahKorhan,
            'korcam' => $korcam,
        ];


        $currentDate = now()->format('Y-m-d');


        $coordinatorName = $korcam->nama_koordinator;

        $pdfFileName = 'KORCAM_' . $coordinatorName . '_' . $currentDate  . '.pdf';

        $pdf = PDF::loadView('korcam.download', $data);
    
        $pdf->setPaper('letter', 'landscape');
        
        return $pdf->download($pdfFileName);

    }

    /**
     * Show the form for creating a new resource.
     */

    public function getKelurahan(Request $request)
    {
        $kelurahan = [];
        if ($search = $request->name) {
            $kelurahan = Kelurahan::where('nama_kelurahan', 'LIKE', "%$search%")->get();
        }
        return response()->json($kelurahan);
    }

    public function getKabkota(Request $request){
        $kota = [];
            $kota = Kabkota::where('nama_kabkota', 'LIKE', "%$request->name%")->get();
            
        return response()->json($kota);
    }

    public function getKorcam(Request $request)
    {
        $korcam = [];
        if ($search = $request->name) {
            $korcam = Korcam::where('nama_koordinator', 'LIKE', "%$search%")
            ->where('deleted','0')->get();
        }
        return response()->json($korcam);
    }

    public function getKorhan(Request $request)
    {
        $korhan = [];
        if ($search = $request->name) {
            $korhan = Korhan::where('nama_koordinator', 'LIKE', "%$search%")
            ->where('deleted','0')->get();
        }
        return response()->json($korhan);
    }

    public function getTps(Request $request)
    {
        $tps = [];

        if ($search = $request->name) {
            $tps = Tpsrw::with('kelurahans')->whereHas('kelurahans', function ($query) use ($search) {
                $query->where('nama_kelurahan', 'LIKE', "%$search%");
            })->get();
        }


        return response()->json($tps);
    }

    public function getKorTps(Request $request)
    {
        $kortps = [];
        if ($search = $request->name) {
            $kortps = KorTps::where('nama_koordinator', 'LIKE', "%$search%")
            ->where('deleted','0')->get();
        }
        return response()->json($kortps);
    }

    public function create()
    {
        $kota = Kabkota::orderBy('nama_kabkota', 'asc')->get();

        return view('korcam.create', compact('kota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_koordinator' => 'required',
            'phone' => 'required',
            'nik' => 'required|unique:korcams,nik',
            'nokk' => 'nullable',
            'kabkota_id' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan_id' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable',
        ],[
            'nama_koordinator.required' => 'nama harus diisi',
            'phone.required' => 'No Telpon harus diisi',
            'nik.required' => 'NIK harus diisi',
            'nik.unique' => 'NIK sudah terdaftar.',
            // 'nokk.required' => 'KK harus diisi',
            'kabkota_id.required' => 'KABKOTA harus diisi',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi',
            'rt.required' => 'RT harus diisi',
            'rw.required' => 'RW harus diisi',
            'kelurahan_id.required' => 'KELURAHAN harus diisi',
            'status.required' => 'Status harus diisi',
            // 'keterangan.required' => 'Keterangan harus diisi',
            'alamat.required' => 'Alamat  harus diisi',
        ]);

        $korcam = new Korcam($validatedData);
        $korcam->user_id = Auth::user()->id;
        $korcam->save();

        // Sinkronisasi mapel_id
        $korcam->tpsrws()->sync($request->input('tpsrw_id', []));

        return redirect()->route('korcam');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Korcam::find($id);
        $tps  = Tpsrw::all();
        $kota = Kabkota::all();

        return view('korcam.edit', compact('tps', 'kota', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_koordinator' => 'required',
            'phone' => 'required',
            'nik' => 'required',
            'nokk' => 'nullable',
            'kabkota_id' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan_id' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable',
            // 'user_id' => 'required',
            'kelurahan_id' => 'required',
        ]);

        $data = Korcam::find($id);
        $data->update($validatedData);

        $data->tpsrws()->sync($request->input('tpsrw_id', []));

        return redirect()->route('korcam');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Korcam $korcam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $data = Korcam::find($id);
        
        $data->deleted = 1;
        $data->save();

        return redirect()->route('korcam');
    }
}
