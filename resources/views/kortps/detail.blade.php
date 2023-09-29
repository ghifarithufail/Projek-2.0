@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">

            <h3 style="text-align: center;">Penanggung Jawab TPS {{$tpsrw->tps}} {{$tpsrw->kelurahans->nama_kelurahan}}</h3>
        </div>
    </div>
    

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
				<div class="menu d-flex justify-content-end">
					<div class="row">
						<div class="col">
							{{-- <div class="text-right">
                                <a href="{{ route('korhan/create') }}">
								    <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                                </a>
							</div> --}}
						</div>
					</div>
					{{-- <div class="head">
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">PDF</a></li>
								<li><a href="#">Excel</a></li>
							</ul>
						</div>
					</div> --}}
				</div>
				
            {{-- </div> --}}
            <div>
                <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                    <b>Total Penanggung Jawab : {{$tpsrw->kortps_count}}</b>
                </div>
                <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                    <b>Target : {{$tpsrw->target}}</b>
                </div>
                <div class="mb-3" style="display: inline-block; margin-right: 20px;">
                    <b>Konstituante : {{$tpsrw->anggotas_count}}</b>
                </div>
                <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col">Nama & Phone</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">Tempat/Tgl Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">RT/RW</th>
                            <th scope="col">Kelurahan / Kecamatan</th>
                            <th scope="col">Korhan</th> 
                            <th scope="col">Korcam</th> 
                            {{-- <th scope="col">Relawan</th>  --}}
                            {{-- <th scope="col">Terverifikasi</th>  --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tpsrw->kortps->where('deleted', 0) as $item)
                        <tr>
                            <td>
                                <a href="{{ route('kortps/details', ['id' => $item->id, 'tps' => $tpsrw->id] ) }}" target="_blank">
                                {{$item->nama_koordinator}}
                                <div>
                                    <small>{{$item->phone}}</small>
                                </div>
                                </a>
                            </td>
                            <td>{{$item->nik}}</td>
                            <td>
                                {{$item->kabkotas->nama_kabkota}}
                                <div>
                                    <small>{{$item->tgl_lahir}}</small>
                                </div>
                            </td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->rt}} / {{$item->rw}}</td>
                            <td>
                                <b>
                                    {{$item->kelurahans->nama_kelurahan}}
                                </b>
                                <div>
                                    <small>{{$item->kelurahans->kecamatan}} - {{$item->kelurahans->kabkota}}</small>
                                </div>
                            </td>
                            <td>
                                {{$item->korhans->nama_koordinator}}
                            </td>
                            <td>{{$item->korhans->koordinators->nama_koordinator}}</td>
                            {{-- <td>{{$tpsrw->anggotas_count}}</td> --}}
                            {{-- <td>{{$tpsrw->anggotas_verified}}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
