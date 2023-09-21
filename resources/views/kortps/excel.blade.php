<table class="table" id="data-table" style="zoom: 0.85;">
    <thead>
        <tr>
            <th>koordinator : {{$kortps->nama_koordinator}}</th>
            <th>Konstituante : {{$jumlahAnggota}}</th>
        </tr>
        <tr></tr>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Phone</th>
            <th scope="col">No KTP/KK</th>
            <th scope="col">Tempat/Tgl Lahir</th>
            <th scope="col">Alamat</th>
            <th scope="col">RT/RW</th>
            <th scope="col" class="text-center">Tps</th>
            {{-- <th scope="col">Bertugas</th>  --}}
            <th scope="col">Phone</th>
            <th scope="col">Status</th>
            <th scope="col">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($anggota as $data)
                            <tr>
                                <td>{{$data->nama_anggota}}</td>
                                <td>{{$data->phone}}</td>
                                <td>
                                    {{$data->nik}}
                                </td>
                                <td>
                                    <b>{{$data->kabkotas->nama_kabkota}}</b>
                                    <div>
                                        <small>{{$data->tgl_lahir}}</small>
                                    </div>
                                </td>
                                <td>{{$data->alamat}}</td>
                                <td>{{$data->rt}} / {{$data->rw}}</td>
                                <td>
                                    <b>{{$data->tps->tps}} {{$data->tps->kelurahans->nama_kelurahan}}</b>
                                    <div>
                                        <small>{{$data->tps->kelurahans->kecamatan}}</small>
                                    </div>
                                </td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->status}}</td>
                                <td>{{$data->keterangan}}</td>
                            </tr>
                        @endforeach
    </tbody>
</table>
