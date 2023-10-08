@extends('layout.index')
@section('content')
    {{-- <h1 class="title text-center">Koordinator Kecamatan</h1> --}}


    <div class="data">
        <div class="content-data">
            <h3 style="text-align: center;">Report Koordinator TPS</h3>
            <hr>
            <form>
                <div class="card-body d-flex justify-content-center">
                    <div class="form-group row">
                        <div class="col-sm-3 mt-2">
                            {{-- <label for="date1">Kelurahan:</label> --}}
                            <input type="text" style="height: 40px" class="form-control" placeholder="Nama" name="nama"
                                id="search_kelurahan">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <input type="text" style="height: 40px" class="form-control" placeholder="korhan"
                                name="korhan" id="search_kecamatan">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <input type="text" style="height: 40px" class="form-control"
                                placeholder="kelurahan atau kecamatan" name="kelurahan" id="search_kecamatan">
                        </div>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary rounded text-white mt-2 mr-2" style="height: 40px"
                            id="search_btn">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="data">
        <div class="content-data">
            {{-- <div class="head"> --}}
            <div class="menu d-flex justify-content-end">
                {{-- <div class="row">
                    <div class="col">
                        <div class="text-right">
                            <a href="{{ route('kortps/create') }}">
                                <button type="button" class="btn btn-success" style="zoom: 0.7">Tambah +</button>
                            </a>
                        </div>
                    </div>
                </div> --}}
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
                <table class="table" style="zoom: 0.7">
                    <thead>
                        <tr>
                            <th scope="col">Nama & Phone</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">Tempat/Tgl Lahir</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">RT/RW</th>
                            <th scope="col">Kelurahan / Kecamatan</th>
                            <th scope="col">Korlur</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">TPS</th>
                            <th scope="col">Konstituante</th>
                            <th scope="col">Target</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kortps as $item)
                        @foreach ($item->tps_pivot as $row)
                            <tr>
                                <td>
                                    <a href="{{ route('kortps/details', ['id' => $item->id, 'tps' => $row->id]) }}">
                                        {{ $item->nama_koordinator }}
                                        <div>
                                            <small>{{ $item->phone }}</small>
                                        </div>
                                    </a>                                    
                                </td>
                                <td>{{ $item->nik }}</td>
                                <td>
                                    {{ $item->kabkotas->nama_kabkota }}
                                    <div>
                                        <small>{{ $item->tgl_lahir }}</small>
                                    </div>
                                </td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->rt }} / {{ $item->rw }}</td>
                                <td>
                                    <b>
                                        {{ $item->kelurahans->nama_kelurahan }}
                                    </b>
                                    <div>
                                        <small>{{ $item->kelurahans->kecamatan }} -
                                            {{ $item->kelurahans->kabkota }}</small>
                                    </div>
                                </td>
                                <td>{{ $item->korhans->nama_koordinator }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    @if ($item->status == '0')
                                        Aktif
                                    @elseif($item->status == '1')
                                        Tidak Aktif
                                    @elseif($item->status == '2')
                                        Keluar
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        <a href="{{ route('kortps/detail', $row->id) }}" target="_blank">
                                            <li>{{ $row->tps }} {{ $row->kelurahans->nama_kelurahan }}</li>
                                        </a>
                                    </ul>
                                </td>
                                <td class="text-center">
                                        @if ($item->anggotas_count < $row->target)
                                            <span class="badge text-bg-warning" style="width: 70px; height: 30px; font-size: 16px; ">{{$item->anggotas_count}}</span>
                                        @elseif($item->anggotas_count == $row->target)
                                            <span class="badge text-bg-success" style="width: 70px; height: 30px; font-size: 16px; ">{{$item->anggotas_count}}</span>
                                        @elseif($item->anggotas_count >$row->target)
                                            <span class="badge text-bg-danger" style="width: 70px; height: 30px; font-size: 16px; ">{{$item->anggotas_count}}</span>
                                        @endif
                                </td>
                                <td class="text-center">{{ $row->target }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                {{ $kortps->links() }}
            </div>
        </div>
    </div>
@endsection
