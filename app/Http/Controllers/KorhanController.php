<?php

namespace App\Http\Controllers;

use App\Models\Kabkota;
use App\Models\Kelurahan;
use App\Models\Korcam;
use App\Models\Korhan;
use App\Models\KorTps;
use App\Models\Tpsrw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use PDF;


class KorhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Korhan::orderBy('created_at', 'desc');

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

        return view('korhan.index', compact('korhan'));
    }

    public function report(Request $request){
        $query = Korhan::withCount('kortps')->orderBy('created_at', 'desc');

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


        return view('korhan.report', compact('korhan'));
    }

    public function details(Request $request, $id){
        $query = KorTps::withCount('anggotas')
        ->where('korhan_id', $id)
        ->orderBy('created_at', 'asc');

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

        $korhan = $query->get();

        $data = Korhan::findOrFail($id);
        $jumlahKonstituante = $korhan->sum('anggotas_count');
        $jumlahKortps = $korhan->count();

        return view('korhan.details', compact('korhan', 'data', 'jumlahKonstituante', 'jumlahKortps'));
    }

    public function pdf(Request $request, $id){
        $query = KorTps::withCount('anggotas')
        ->where('korhan_id', $id)
        ->orderBy('created_at', 'asc');

        $korhan = $query->get();

        $data = Korhan::findOrFail($id);
        $jumlahKonstituante = $korhan->sum('anggotas_count');
        $jumlahKortps = $korhan->count();

        return view('korhan.pdf', compact('korhan', 'data', 'jumlahKonstituante', 'jumlahKortps'));
    }

    public function download($id){
        $query = KorTps::withCount('anggotas')
        ->where('korhan_id', $id)
        ->orderBy('created_at', 'asc');

        $korhan = $query->get();

        $item = Korhan::findOrFail($id);
        $jumlahKonstituante = $korhan->sum('anggotas_count');
        $jumlahKortps = $korhan->count();


        $data = [
            'korhan' => $korhan,
            'jumlahKonstituante' => $jumlahKonstituante,
            'jumlahKortps' => $jumlahKortps,
            'item' => $item,
        ];


        $currentDate = now()->format('Y-m-d');


        $coordinatorName = $item->nama_koordinator;

        $pdfFileName = 'KORHAN_' . $coordinatorName . '_' . $currentDate  . '.pdf';

        $pdf = PDF::loadView('korhan.download', $data);
    
        $pdf->setPaper('letter', 'landscape');
        
        return $pdf->download($pdfFileName);

    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kota = Kabkota::orderBy('nama_kabkota', 'asc')->get();

        return view('korhan.create', compact( 'kota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_koordinator' => 'required',
            'phone' => 'required',
            'nik' => 'required|unique:korhans,nik',
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
            'korcam_id' => 'required',
            'tpshan_id' => 'required',
        ],
        [
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
            'korcam_id.required' => 'Korcam  harus diisi',
            'tpshan_id.required' => 'TPS  harus diisi',
        ]);

        $korhan = new Korhan($validatedData);
        $korhan->user_id = Auth::user()->id;

        $korhan->save();

        // Sinkronisasi mapel_id
        $korhan->pivot_korhans()->sync($request->input('tpshan_id',[]));

        return redirect()->route('korhan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Korhan $korhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Korhan::with('pivot_korhans')->find($id);
        $tps  = Tpsrw::all();
        $kota = Kabkota::all();
        $korcam = Korcam::all();

        // dd($data);

        return view('korhan.edit', compact( 'tps', 'kota', 'data','korcam' ));
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
            'korcam_id' => 'required',
        ]);

        $korhan = Korhan::find($id);
        $korhan->update($validatedData);

        // Sinkronisasi mapel_id
        $korhan->pivot_korhans()->sync($request->input('tpshan_id',[]));

        return redirect()->route('korhan');
    }
    
    public function detail($id){
        $korhan = Korhan::where('kelurahan_id',$id)->get();
        $kelurahan = Kelurahan::find($id);
        $jumlahKorhan = $korhan->count();

        return view('korhan.detail', compact('korhan','kelurahan','jumlahKorhan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Korhan $korhan)
    {
        //
    }
}
